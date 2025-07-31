<?php

namespace App\Livewire\Admin\Authors;

use App\Models\Author;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class ManageAuthors extends Component
{
    public $authors;
    public $isModalOpen = false;
    public $author_id;

    // Поля формы
    public $name = '';
    public $bio = '';
    public $image_path = '';

    public function render()
    {
        $this->authors = Author::latest()->get();
        return view('livewire.admin.authors.manage-authors');
    }

    public function create()
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        $this->author_id = $id;
        $this->name = $author->name;
        $this->bio = $author->bio;
        $this->image_path = $author->image_path;

        $this->isModalOpen = true;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image_path' => 'nullable|string|max:255',
        ]);

        Author::updateOrCreate(['id' => $this->author_id], $validatedData);

        session()->flash('message', $this->author_id ? 'Автор успешно обновлен.' : 'Автор успешно создан.');

        $this->closeModal();
    }

    public function delete($id)
    {
        Author::find($id)->delete();
        session()->flash('message', 'Автор успешно удален.');
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->author_id = null;
        $this->name = '';
        $this->bio = '';
        $this->image_path = '';
    }
}
