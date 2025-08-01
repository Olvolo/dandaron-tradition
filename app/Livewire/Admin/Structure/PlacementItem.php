<?php

namespace App\Livewire\Admin\Structure;

use App\Models\Placement;
use Livewire\Component;

class PlacementItem extends Component
{
    public Placement $placement;
    public bool $open = true;

    public function createChildPlacement()
    {
        $this->dispatch('createPlacement', parentId: $this->placement->id);
    }

    public function editPlacement()
    {
        $this->dispatch('editPlacement', placementId: $this->placement->id);
    }

    public function deletePlacement()
    {
        $this->dispatch('deletePlacement', placementId: $this->placement->id);
    }

    public function render()
    {
        return view('livewire.admin.structure.placement-item');
    }
}
