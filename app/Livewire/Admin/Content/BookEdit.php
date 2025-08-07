<?php

namespace App\Livewire\Admin\Content;

use App\Models\Author;
use App\Models\Book;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class BookEdit extends Component
{
    public Book $book;

    public $title;
    public $description;
    public $annotation;
    public $custom_styles;
    public array $selectedAuthors = [];

    public function mount(Book $book): void
    {
        $this->book = $book;
        $this->title = $book->title;
        $this->description = $book->description;
        $this->annotation = $book->annotation;
        $this->custom_styles = $book->custom_styles;
        $this->selectedAuthors = $book->authors->pluck('id')->toArray();
    }

    public function updateBook(): null
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
        return $this->redirect(route('admin.books.edit', $this->book));
    }

    public function render()
    {
        return view('livewire.admin.content.book-edit', [
            'allAuthors' => Author::all(),
        ]);
    }
}
