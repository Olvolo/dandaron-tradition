<?php

namespace App\Livewire\Admin\Content;

use App\Models\Author;
use App\Models\Book;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class ManageBooks extends Component
{
    public bool $isModalOpen = false;
    public $book_id;

    // Поля формы
    public $title = '';
    public $description = '';
    public $annotation = '';
    public $custom_styles = '';
    public $is_protected = false;
    public $selectedAuthors = [];

    public function render()
    {
        return view('livewire.admin.content.manage-books', [
            'books' => Book::with('authors')->latest()->get(),
            'allAuthors' => Author::all(),
        ]);
    }

    public function create(): void
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function edit($id): void
    {
        $book = Book::with('authors')->findOrFail($id);
        $this->book_id = $id;
        $this->title = $book->title;
        $this->description = $book->description;
        $this->annotation = $book->annotation;
        $this->custom_styles = $book->custom_styles;
        $this->is_protected = $book->is_protected;
        $this->selectedAuthors = $book->authors->pluck('id')->toArray();

        $this->isModalOpen = true;
    }

    public function store(): void
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'annotation' => 'nullable|string',
            'custom_styles' => 'nullable|string',
            'is_protected' => 'boolean',
        ]);

        $book = Book::updateOrCreate(['id' => $this->book_id], $validatedData);
        $book->authors()->sync($this->selectedAuthors);

        session()->flash('message', $this->book_id ? 'Книга успешно обновлена.' : 'Книга успешно создана.');
        $this->closeModal();
    }

    public function delete($id): void
    {
        Book::find($id)->delete();
        session()->flash('message', 'Книга успешно удалена.');
    }

    public function closeModal(): void
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->book_id = null;
        $this->title = '';
        $this->description = '';
        $this->annotation = '';
        $this->custom_styles = '';
        $this->is_protected = false;
        $this->selectedAuthors = [];
    }
}
