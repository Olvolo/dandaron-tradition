<?php

namespace App\View\Components;

use App\Models\Placement;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class HeaderNavigation extends Component
{
    public Collection $items;

    public function __construct()
    {
        $homePlacement = Placement::whereNull('parent_id')->first();

        if ($homePlacement) {
            $this->items = $homePlacement->children()
                ->where('show_in_menu', true)
                ->with(['children' => function($query) {
                    $query->where('show_in_menu', true)->orderBy('order_column');
                }])
                ->orderBy('order_column')
                ->get();
        } else {
            $this->items = collect();
        }
    }

    public function render()
    {
        return view('components.header-navigation');
    }
}
