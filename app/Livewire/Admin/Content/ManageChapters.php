<?php

namespace App\Livewire\Admin\Content;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ManageChapters extends Component
{
    public Book $book;

    public bool $isChapterModalOpen = false;

    public ?int $chapter_id = null;
    public ?int $chapter_parent_id = null;
    public $chapter_title = '';
    public $chapter_order_column = 0;
    public $chapter_content_html = '';
    public $custom_styles = '';

    protected $listeners = [
        'createChapter' => 'createChapter',
        'editChapter' => 'editChapter',
        'deleteChapter' => 'deleteChapter',
    ];

    /**
     * Проверка прав доступа при каждом запросе Livewire.
     */
    public function boot(): void
    {
        Gate::authorize('manage-structure');
    }

    /**
     * Открывает форму создания главы.
     */
    public function createChapter(?int $parentId = null): void
    {
        $this->resetChapterForm();

        if ($parentId !== null) {
            $parent = $this->book->chapters()->findOrFail($parentId);

            $this->chapter_parent_id = $parent->id;
        }

        $this->isChapterModalOpen = true;
    }

    /**
     * Открывает форму редактирования главы.
     */
    public function editChapter(int $chapterId): void
    {
        $chapter = $this->book->chapters()->findOrFail($chapterId);

        $this->chapter_id = $chapter->id;
        $this->chapter_parent_id = $chapter->parent_id;
        $this->chapter_title = $chapter->title;
        $this->chapter_order_column = $chapter->order_column;
        $this->chapter_content_html = $chapter->content_html;
        $this->custom_styles = $chapter->custom_styles;

        $this->isChapterModalOpen = true;
    }

    /**
     * Удаляет главу, если у неё нет дочерних глав.
     */
    public function deleteChapter(int $chapterId): void
    {
        $chapter = $this->book->chapters()->findOrFail($chapterId);

        if ($chapter->children()->exists()) {
            session()->flash('chapter_error',
            'Невозможно удалить главу, пока у неё есть дочерние главы. Сначала переместите или удалите дочерние главы.'
            );

            return;
        }

        $chapter->delete();

        session()->flash('chapter_message', 'Глава успешно удалена.');
    }

    /**
     * Создаёт новую главу или сохраняет изменения существующей.
     */
    public function storeChapter(): void
    {
        $validatedData = $this->validate([
            'chapter_id' => [
                'nullable',
                'integer',
                Rule::exists('chapters', 'id')
                    ->where('book_id', $this->book->id),
            ],

            'chapter_parent_id' => [
                'nullable',
                'integer',
                Rule::exists('chapters', 'id')
                    ->where('book_id', $this->book->id),
            ],

            'chapter_title' => [
                'required',
                'string',
                'max:255',
            ],

            'chapter_order_column' => [
                'required',
                'integer',
            ],

            'chapter_content_html' => [
                'required',
                'string',
            ],

            'custom_styles' => [
                'nullable',
                'string',
            ],
        ]);

        // Получаем редактируемую главу только из текущей книги.
        $chapter = $validatedData['chapter_id'] !== null
            ? $this->book->chapters()->findOrFail($validatedData['chapter_id'])
            : null;

        // Проверяем родительскую связь и отсутствие циклов.
        $this->validateParentHierarchy(
            $validatedData['chapter_parent_id'],
            $chapter
        );

        // При редактировании сохраняем прежний адрес главы.
        // Новый slug формируется только при создании.
        $slug = $chapter
            ? $chapter->slug
            : $this->generateUniqueSlug($validatedData['chapter_title']);

        $data = [
            'parent_id' => $validatedData['chapter_parent_id'],
            'title' => $validatedData['chapter_title'],
            'slug' => $slug,
            'order_column' => $validatedData['chapter_order_column'],
            'content_html' => $validatedData['chapter_content_html'],
            'custom_styles' => $validatedData['custom_styles'],
        ];

        try {
            if ($chapter) {
                $chapter->fill($data);
                $chapter->save();

                $message = 'Глава обновлена.';
            } else {
                $this->book->chapters()->create($data);

                $message = 'Глава создана.';
            }
        } catch (UniqueConstraintViolationException $exception) {
            throw ValidationException::withMessages([
                'chapter_title' => 'Не удалось сохранить главу: такой адрес уже занят. Повторите попытку.',
            ]);
        }

        session()->flash('chapter_message', $message);

        $this->closeChapterModal();
    }

    /**
     * Проверяет родительскую иерархию и исключает циклические связи.
     */
    private function validateParentHierarchy(
    ?int $parentId,
    ?Chapter $chapter = null
    ): void {
        if ($parentId === null) {
            return;
        }

        $currentId = (int) $parentId;
        $visited = [];

        while ($currentId !== null) {
            // Нельзя назначить родителем саму редактируемую главу.
            if ($chapter && $currentId === (int) $chapter->id) {
                throw ValidationException::withMessages([
                    'chapter_parent_id' =>
                        'Нельзя поместить главу внутрь самой себя или собственного подраздела.',
                ]);
            }

            // Защита от уже существующей циклической связи.
            if (isset($visited[$currentId])) {
                throw ValidationException::withMessages([
                    'chapter_parent_id' =>
                        'Обнаружена циклическая структура глав. Необходимо исправить иерархию.',
                ]);
            }

            $visited[$currentId] = true;

            // Каждый предок должен принадлежать текущей книге.
            $current = $this->book->chapters()
                ->select(['id', 'parent_id'])
                ->find($currentId);

            if (!$current) {
                throw ValidationException::withMessages([
                    'chapter_parent_id' =>
                        'Родительская глава или один из её предков не принадлежит текущей книге.',
                ]);
            }

            $currentId = $current->parent_id;
        }
    }

    /**
     * Создаёт уникальный slug в пределах текущей книги.
     */
    private function generateUniqueSlug(string $title): string
    {
        $baseSlug = Str::slug($title);

        if ($baseSlug === '') {
            $baseSlug = 'chapter';
        }

        $slug = $baseSlug;
        $counter = 2;

        while (
            $this->book->chapters()
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Закрывает окно редактирования.
     */
    public function closeChapterModal(): void
    {
        $this->isChapterModalOpen = false;

        $this->resetChapterForm();
    }

    /**
     * Сбрасывает поля формы.
     */
    private function resetChapterForm(): void
    {
        $this->chapter_id = null;
        $this->chapter_parent_id = null;
        $this->chapter_title = '';
        $this->chapter_order_column = 0;
        $this->chapter_content_html = '';
        $this->custom_styles = '';
    }

    /**
     * Отображает дерево глав текущей книги.
     */
    public function render()
    {
        $rootChapters = $this->book
            ->chapters()
            ->whereNull('parent_id')
            ->with('childrenRecursive')
            ->orderBy('order_column')
            ->get();

        return view('livewire.admin.content.manage-chapters', [
            'rootChapters' => $rootChapters,
        ]);
    }
}
