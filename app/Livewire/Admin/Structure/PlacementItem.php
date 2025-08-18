<?php

namespace App\Livewire\Admin\Structure;

use App\Models\Placement;
use Livewire\Component;

class PlacementItem extends Component
{
    public Placement $placement;
    public $open = false;

    public function toggle(): void
    {
        $this->open = !$this->open;
    }
    public function createChildPlacement(): void
    {
        $this->dispatch('createPlacement', parentId: $this->placement->id);
    }

    public function editPlacement(): void
    {
        $this->dispatch('editPlacement', placementId: $this->placement->id);
    }

    public function deletePlacement(): void
    {
        $this->dispatch('deletePlacement', placementId: $this->placement->id);
    }

    public function render()
    {
        return view('livewire.admin.structure.placement-item');
    }
}
