<?php

namespace App\Livewire\Admin\Structure;

use App\Models\Article;
use App\Models\Book;
use App\Models\Placement;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.admin')]
class ManagePlacements extends Component
{
    public bool $isModalOpen = false;

    public $placement_id = null;
    public $parent_id = null;

    public string $title = '';
    public string $slug = '';
    public $order_column = 0;

    public $show_in_menu = false;
    public $show_on_main = false;
    public $is_protected = false;

    public $background_image_url = '';
    public $custom_styles = '';

    public $article_link_id = null;
    public $book_link_id = null;

    /**
     * Выполняется при КАЖДОМ запросе Livewire, включая вызовы методов и события.
     * Ability manage-structure должна быть зарегистрирована в Gate приложения.
     */
    public function boot(): void
    {
        Gate::authorize('manage-structure');
    }

    public function updatedArticleLinkId($value): void
    {
        if ($value) {
            $this->book_link_id = null;
        }
    }

    public function updatedBookLinkId($value): void
    {
        if ($value) {
            $this->article_link_id = null;
        }
    }

    public function render()
    {
        return view('livewire.admin.structure.manage-placements', [
            'placements' => Placement::whereNull('parent_id')
                ->with('childrenRecursive')
                ->orderBy('order_column')
                ->get(),

            // Списки нужны только в открытой форме и только с id и title.
            'articles' => $this->isModalOpen
                ? Article::orderBy('title')->get(['id', 'title'])
                : collect(),

            'books' => $this->isModalOpen
                ? Book::orderBy('title')->get(['id', 'title'])
                : collect(),
        ]);
    }

    protected function rules(): array
    {
        return [
            'placement_id' => ['nullable', 'integer', 'exists:placements,id'],
            'parent_id' => ['nullable', 'integer', 'exists:placements,id'],

            'title' => ['required', 'string', 'max:255'],

            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('placements', 'slug')
                    ->where(fn ($query) => $this->parent_id === null
                        ? $query->whereNull('parent_id')
                        : $query->where('parent_id', $this->parent_id))
                    ->ignore($this->placement_id),
            ],

            'order_column' => ['required', 'integer'],

            'show_in_menu' => ['boolean'],
            'show_on_main' => ['boolean'],
            'is_protected' => ['boolean'],

            'background_image_url' => ['nullable', 'string', 'max:255'],
            'custom_styles' => ['nullable', 'string'],

            'article_link_id' => ['nullable', 'integer', 'exists:articles,id'],
            'book_link_id' => ['nullable', 'integer', 'exists:books,id'],
        ];
    }

    #[On('createPlacement')]
    public function create($parentId = null): void
    {
        $this->resetForm();

        $this->parent_id = filled($parentId)
            ? Placement::findOrFail($this->validateId($parentId))->id
            : null;

        $this->isModalOpen = true;
    }

    #[On('editPlacement')]
    public function edit($placementId): void
    {
        $placement = Placement::findOrFail($this->validateId($placementId));

        $this->fill($placement->only([
            'title',
            'slug',
            'order_column',
            'show_in_menu',
            'show_on_main',
            'is_protected',
            'background_image_url',
            'custom_styles',
        ]));

        $this->placement_id = $placement->id;
        $this->parent_id = $placement->parent_id;

        $this->article_link_id = $placement->placementable_type === Article::class
            ? $placement->placementable_id
            : null;

        $this->book_link_id = $placement->placementable_type === Book::class
            ? $placement->placementable_id
            : null;

        $this->resetValidation();
        $this->isModalOpen = true;
    }

    public function store(): void
    {
        $idFields = ['placement_id', 'parent_id', 'article_link_id', 'book_link_id'];

        // 1. Пустые строки из полей формы превращаем в null, остальное не трогаем.
        foreach ($idFields as $key) {
            if ($this->$key === '') {
                $this->$key = null;
            }
        }

        // 2. Проверка типов до приведения. Существование записей проверит основной проход.
        $this->validate([
            'placement_id' => ['nullable', 'integer'],
            'parent_id' => ['nullable', 'integer'],
            'article_link_id' => ['nullable', 'integer'],
            'book_link_id' => ['nullable', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
        ]);

        // 3. Типы проверены, теперь приведение безопасно.
        foreach ($idFields as $key) {
            if ($this->$key !== null) {
                $this->$key = (int) $this->$key;
            }
        }

        // 4. Если slug не указан, он строится из заголовка.
        $this->slug = Str::slug(filled($this->slug) ? $this->slug : $this->title);

        // 5. Основная проверка: exists, уникальность slug внутри родителя и остальные поля.
        $data = $this->validate();

        $articleId = $data['article_link_id'] ?? null;
        $bookId = $data['book_link_id'] ?? null;

        if ($articleId !== null && $bookId !== null) {
            throw ValidationException::withMessages([
                'article_link_id' => 'Можно выбрать только одну привязку: либо статью, либо книгу.',
            ]);
        }

        $isUpdate = $this->placement_id !== null;

        $attributes = Arr::except($data, ['placement_id', 'article_link_id', 'book_link_id']);

        [$attributes['placementable_type'], $attributes['placementable_id']] = match (true) {
            $articleId !== null => [Article::class, $articleId],
            $bookId !== null => [Book::class, $bookId],
            default => [null, null],
        };

        try {
            DB::transaction(function () use ($attributes, $isUpdate) {
                $placement = new Placement;

                if ($isUpdate) {
                    // Блокировка снижает риск конфликтов, но полной защиты от
                    // параллельных перемещений разных узлов не даёт.
                    $placement = Placement::lockForUpdate()->findOrFail($this->placement_id);

                    if ($attributes['parent_id'] !== null) {
                        $newParent = Placement::lockForUpdate()->findOrFail($attributes['parent_id']);

                        if ($newParent->is($placement) || $newParent->isDescendantOf($placement)) {
                            throw ValidationException::withMessages([
                                'parent_id' => 'Нельзя поместить раздел внутрь самого себя или собственного подраздела.',
                            ]);
                        }
                    }
                }

                $placement->fill($attributes)->save();
            });
        } catch (UniqueConstraintViolationException) {
            // Срабатывает при гонке параллельных записей (уникальный индекс в БД).
            throw ValidationException::withMessages([
                'slug' => 'Такой адрес уже занят. Измените адрес и повторите.',
            ]);
        }

        session()->flash('message', $isUpdate
            ? 'Элемент структуры обновлён.'
            : 'Элемент структуры создан.');

        $this->closeModal();
    }

    /**
     * Удаление раздела вместе со всем поддеревом.
     * Каскад обеспечивает внешний ключ parent_id (onDelete cascade).
     * Статьи и книги не затрагиваются.
     */
    #[On('deletePlacement')]
    public function delete($placementId): void
    {
        Placement::findOrFail($this->validateId($placementId))->delete();

        session()->flash('message', 'Элемент структуры и его подразделы удалены.');
    }

    /**
     * Проверка идентификатора, пришедшего через событие Livewire.
     * Только тип: отсутствие записи обработает findOrFail().
     */
    private function validateId($id): int
    {
        validator(
            ['id' => $id],
            ['id' => ['required', 'integer']]
        )->validate();

        return (int) $id;
    }

    public function closeModal(): void
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->reset([
            'placement_id', 'parent_id',
            'title', 'slug', 'order_column',
            'show_in_menu', 'show_on_main', 'is_protected',
            'background_image_url', 'custom_styles',
            'article_link_id', 'book_link_id',
        ]);

        $this->resetValidation();
    }
}
