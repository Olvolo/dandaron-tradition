<?php

namespace App\View\Components;

use App\Models\Placement;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class Navigation extends Component
{
    public Collection $items;

    public function __construct()
    {
        // Находим главную страницу (единственный элемент без родителя)
        $homePlacement = Placement::whereNull('parent_id')->first();

        if ($homePlacement) {
            // Получаем только детей главной страницы, которые должны показываться в меню
            // Загружаем их детей заранее для dropdown меню, тоже фильтруя по show_in_menu
            $this->items = $homePlacement->children()
                ->where('show_in_menu', true)
                ->with(['children' => function($query) {
                    $query->where('show_in_menu', true)->orderBy('order_column');
                }])
                ->orderBy('order_column')
                ->get();
        } else {
            // Если главная страница не найдена, меню будет пустым
            $this->items = collect();
        }
    }

    public function render()
    {
        return view('components.navigation');
    }
}
