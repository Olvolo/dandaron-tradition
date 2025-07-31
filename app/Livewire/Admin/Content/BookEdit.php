<?php

namespace App\Livewire\Admin\Content;

use App\Models\Author;
use App\Models\Book;
use App\Models\Chapter;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class BookEdit extends Component
{
    public Book $book;

    // Поля формы
    public $title;
    public $description;
    public $annotation;
    public $custom_styles;
    public $selectedAuthors = [];

    // Свойства для модального окна Глав
    public $isChapterModalOpen = false;
    public $chapter_id;
    public $chapter_parent_id = null;
    public $chapter_title = '';
    public $chapter_order_column = 0;
    public $chapter_content_html = '';

    // --- Методы для КНИГИ ---
    public function updateBook()
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'annotation' => 'nullable|string',
            'custom_styles' => 'nullable|string',
        ]);

        $this->book->update($validatedData);
        $this->book->authors()->sync($this->selectedAuthors);
        session()->flash('message', 'Данные книги успешно обновлены.');
    }

    // --- Методы для ГЛАВ ---
    public function createChapter($parentId = null)
    {
        $this->resetChapterForm();
        $this->chapter_parent_id = $parentId;
        $this->isChapterModalOpen = true;
    }

    public function editChapter($id)
    {
        $chapter = Chapter::findOrFail($id);
        $this->chapter_id = $id;
        $this->chapter_parent_id = $chapter->parent_id;
        $this->chapter_title = $chapter->title;
        $this->chapter_order_column = $chapter->order_column;
        $this->chapter_content_html = $chapter->content_html;
        $this->isChapterModalOpen = true;
    }

    public function storeChapter()
    {
        $validatedData = $this->validate([
            'chapter_parent_id' => 'nullable|exists:chapters,id',
            'chapter_title' => 'required|string|max:255',
            'chapter_order_column' => 'required|integer',
            'chapter_content_html' => 'required|string',
        ]);

        $this->book->chapters()->updateOrCreate(
            ['id' => $this->chapter_id],
            [
                'parent_id' => $validatedData['chapter_parent_id'],
                'title' => $validatedData['chapter_title'],
                'order_column' => $validatedData['chapter_order_column'],
                'content_html' => $validatedData['chapter_content_html'],
            ]
        );

        session()->flash('chapter_message', $this->chapter_id ? 'Глава успешно обновлена.' : 'Глава успешно создана.');
        $this->closeChapterModal();

        // ВАЖНО: Перезагружаем связи, чтобы увидеть новую главу
        $this->book->load(['chapters' => function ($query) {
            $query->whereNull('parent_id')->with('childrenRecursive')->orderBy('order_column');
        }]);
    }

    public function deleteChapter($id)
    {
        Chapter::find($id)->delete();
        session()->flash('chapter_message', 'Глава успешно удалена.');
        // Перезагружаем книгу, чтобы обновить список глав
        $this->book->load('chapters.children');
    }

    public function closeChapterModal()
    {
        $this->isChapterModalOpen = false;
        $this->resetChapterForm();
    }

    private function resetChapterForm()
    {
        $this->chapter_id = null;
        $this->chapter_parent_id = null;
        $this->chapter_title = '';
        $this->chapter_order_column = 0;
        $this->chapter_content_html = '';
    }

    public function render()
    {
        return view('livewire.admin.content.book-edit', [
            'allAuthors' => Author::all(),
            // Теперь мы просто используем уже загруженные данные
            'rootChapters' => $this->book->chapters,
        ]);
    }

    // Метод, который вызывается при инициализации компонента
    public function mount(Book $book)
    {
        $this->book = $book;
        // Загружаем только корневые главы, а они уже подтянут всех потомков
        $this->book->load(['chapters' => function ($query) {
            $query->whereNull('parent_id')->with('childrenRecursive')->orderBy('order_column');
        }]);
        $this->title = $book->title;
        $this->description = $book->description;
        $this->annotation = $book->annotation;
        $this->custom_styles = $book->custom_styles;
        $this->selectedAuthors = $book->authors->pluck('id')->toArray();
    }

}
