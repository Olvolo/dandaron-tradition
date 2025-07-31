<?php

namespace App\View\Composers;

use App\Models\Placement;
use Illuminate\View\View;

class MainMenuComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $menuItems = Placement::whereNull('parent_id')
            ->where('show_in_menu', true)
            ->with('childrenRecursive')
            ->orderBy('order_column')
            ->get();

        $view->with('menuItems', $menuItems);
    }
}
