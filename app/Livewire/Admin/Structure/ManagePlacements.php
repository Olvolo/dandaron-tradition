<?php

namespace App\Livewire\Admin\Structure;

use App\Models\Placement;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class ManagePlacements extends Component
{
    public $isModalOpen = false;
    public $placement_id;
    public $parent_id;
    public $title = '';
    public $slug = '';
    public $order_column = 0; // <-- Новое свойство
    public $show_in_menu = false;
    public $show_on_main = false;

    // TODO: Сюда будем загружать списки статей и книг для привязки
    public $articles = [];
    public $books = [];

    public function render()
    {
        $placements = Placement::whereNull('parent_id')
            ->with('children')
            ->orderBy('order_column')
            ->get();

        return view('livewire.admin.structure.manage-placements', [
            'placements' => $placements,
        ]);
    }

    public function create($parentId = null)
    {
        $this->resetForm();
        $this->parent_id = $parentId;
        $this->isModalOpen = true;
    }

    public function edit($id)
    {
        $placement = Placement::findOrFail($id);
        $this->placement_id = $id;
        $this->parent_id = $placement->parent_id;
        $this->title = $placement->title;
        $this->slug = $placement->slug;
        $this->order_column = $placement->order_column;
        $this->show_in_menu = $placement->show_in_menu;
        $this->show_on_main = $placement->show_on_main;

        // TODO: Загрузить данные о привязанном контенте
        // $this->placementable_type = $placement->placementable_type;
        // $this->placementable_id = $placement->placementable_id;

        $this->isModalOpen = true;
    }

    public function store()
    {
        $this->slug = $this->slug ? Str::slug($this->slug) : Str::slug($this->title);

        $validatedData = $this->validate([
            'parent_id' => 'nullable|exists:placements,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'order_column' => 'required|integer',
            'show_in_menu' => 'boolean',
            'show_on_main' => 'boolean',
        ]);

        Placement::updateOrCreate(['id' => $this->placement_id], $validatedData);

        session()->flash('message', $this->placement_id ? 'Элемент структуры обновлен.' : 'Элемент структуры создан.');

        $this->closeModal();
    }

    public function delete($id)
    {
        Placement::find($id)->delete();
        session()->flash('message', 'Элемент структуры удален.');
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->placement_id = null;
        $this->parent_id = null;
        $this->title = '';
        $this->slug = '';
        $this->order_column = 0;
        $this->show_in_menu = false;
        $this->show_on_main = false;
    }
}
