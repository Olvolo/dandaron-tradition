<?php

namespace App\Livewire\Admin\Taxonomy;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class ManageTaxonomy extends Component
{
    public $categories;
    public $tags;

    // Свойства для формы
    public $isModalOpen = false;
    public string $modelType = 'Category'; // 'Category' или 'Tag'
    public $itemId;
    public $name = '';
    public $slug = '';

    public function render()
    {
        $this->categories = Category::latest()->get();
        $this->tags = Tag::latest()->get();
        return view('livewire.admin.taxonomy.manage-taxonomy');
    }

    public function create($modelType): void
    {
        $this->resetForm();
        $this->modelType = $modelType;
        $this->isModalOpen = true;
    }

    public function edit($modelType, $id): void
    {
        $this->modelType = $modelType;
        $modelClass = 'App\\Models\\' . $this->modelType;
        $item = $modelClass::findOrFail($id);

        $this->itemId = $id;
        $this->name = $item->name;
        $this->slug = $item->slug;

        $this->isModalOpen = true;
    }

    public function store(): void
    {
        $this->slug = Str::slug($this->name); // Автоматически генерируем slug

        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        $modelClass = 'App\\Models\\' . $this->modelType;
        $modelClass::updateOrCreate(['id' => $this->itemId], $validatedData);

        session()->flash('message', $this->modelType . ($this->itemId ? ' успешно обновлена.' : ' успешно создана.'));

        $this->closeModal();
    }

    public function delete($modelType, $id): void
    {
        $modelClass = 'App\\Models\\' . $modelType;
        $modelClass::find($id)->delete();
        session()->flash('message', $modelType . ' успешно удалена.');
    }

    public function closeModal(): void
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->itemId = null;
        $this->name = '';
        $this->slug = '';
    }
}
