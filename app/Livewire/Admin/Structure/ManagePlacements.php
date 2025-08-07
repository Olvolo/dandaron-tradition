<?php

namespace App\Livewire\Admin\Structure;

use App\Models\Article;
use App\Models\Book;
use App\Models\Placement;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.admin')]
class ManagePlacements extends Component
{
    public bool $isModalOpen = false;
    public $placements;
    public $placement_id;
    public $parent_id;
    public $title = '';
    public $slug = '';
    public $order_column = 0;
    public $show_in_menu = false;
    public $show_on_main = false;
    public $is_protected = false;
    public  $background_image_url = '';
    public  $custom_styles = '';

    // Новые свойства для связи
    public $article_link_id = null;
    public $book_link_id = null;

    // Этот метод сработает КАЖДЫЙ раз, когда меняется $article_link_id
    public function updatedArticleLinkId($value): void
    {
        if ($value) {
            $this->book_link_id = null; // Сбрасываем выбор книги
        }
    }

    // Этот метод сработает КАЖДЫЙ раз, когда меняется $book_link_id
    public function updatedBookLinkId($value): void
    {
        if ($value) {
            $this->article_link_id = null; // Сбрасываем выбор статьи
        }
    }

    public function render()
    {
        // The main error was here: changed 'order' to 'order_column'
        $this->placements = Placement::whereNull('parent_id')->with('childrenRecursive')->orderBy('order_column')->get();

        return view('livewire.admin.structure.manage-placements', [
            'articles' => Article::all(),
            'books' => Book::all(),
        ]);
    }

    #[On('createPlacement')]
    public function create($parentId = null): void
    {
        $this->resetForm();
        $this->parent_id = $parentId;
        $this->isModalOpen = true;
    }

    #[On('editPlacement')]
    public function edit($placementId): void
    {
        $placement = Placement::findOrFail($placementId);
        $this->placement_id = $placementId;
        $this->parent_id = $placement->parent_id;
        $this->title = $placement->title;
        $this->slug = $placement->slug;
        $this->order_column = $placement->order_column;
        $this->show_in_menu = $placement->show_in_menu;
        $this->show_on_main = $placement->show_on_main;
        $this->is_protected = $placement->is_protected;
        $this->background_image_url = $placement->background_image_url;
        $this->custom_styles = $placement->custom_styles;

        if ($placement->placementable_type === 'App\\Models\\Article') {
            $this->article_link_id = $placement->placementable_id;
        } elseif ($placement->placementable_type === 'App\\Models\\Book') {
            $this->book_link_id = $placement->placementable_id;
        }

        $this->isModalOpen = true;
    }

    public function store(): void
    {
        $this->slug = $this->slug ? Str::slug($this->slug) : Str::slug($this->title);

        $validatedData = $this->validate([
            'parent_id' => 'nullable|exists:placements,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:placements,slug,'.$this->placement_id,
            'order_column' => 'required|integer',
            'show_in_menu' => 'boolean',
            'show_on_main' => 'boolean',
            'is_protected' => 'boolean',
            'background_image_url' => 'nullable|string|max:255',
            'custom_styles' => 'nullable|string',
        ]);

        if ($this->article_link_id) {
            $validatedData['placementable_type'] = 'App\\Models\\Article';
            $validatedData['placementable_id'] = $this->article_link_id;
        } elseif ($this->book_link_id) {
            $validatedData['placementable_type'] = 'App\\Models\\Book';
            $validatedData['placementable_id'] = $this->book_link_id;
        } else {
            $validatedData['placementable_type'] = null;
            $validatedData['placementable_id'] = null;
        }

        Placement::updateOrCreate(['id' => $this->placement_id], $validatedData);
        session()->flash('message', $this->placement_id ? 'Элемент структуры обновлен.' : 'Элемент структуры создан.');
        $this->closeModal();
    }

    #[On('deletePlacement')]
    public function delete($placementId): void
    {
        Placement::find($placementId)->delete();
        session()->flash('message', 'Элемент структуры удален.');
    }

    public function closeModal(): void
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->placement_id = null;
        $this->parent_id = null;
        $this->title = '';
        $this->slug = '';
        $this->order_column = 0;
        $this->show_in_menu = false;
        $this->show_on_main = false;
        $this->is_protected = false;
        $this->article_link_id = null;
        $this->book_link_id = null;
        $this->background_image_url = '';
        $this->custom_styles = '';
    }
}
