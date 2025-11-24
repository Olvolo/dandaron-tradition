@php use App\Models\Placement; @endphp
@props(['items' => null])

@php
    // Используем database кеш с правильным ключом
    $menuItems = $items ?? cache()->remember('menu_tree_optimized', 3600, function () {
        return Placement::whereNull('parent_id')
            ->select('id', 'parent_id', 'title', 'full_slug')
            ->with(['children' => function($query) {
                $query->select('id', 'parent_id', 'title', 'full_slug')
                    ->orderBy('order_column')
                    ->with(['children' => function($q) {
                        $q->select('id', 'parent_id', 'title', 'full_slug')
                            ->orderBy('order_column')
                            ->with(['children' => function($q2) {
                                $q2->select('id', 'parent_id', 'title', 'full_slug')
                                    ->orderBy('order_column');
                            }]);
                    }]);
            }])
            ->orderBy('order_column')
            ->get();
    });
@endphp

<div class="space-y-0.5">
    @foreach ($menuItems as $item)
        <x-tree-menu-item :item="$item" :level="0"/>
    @endforeach
</div>
