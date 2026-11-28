
@php use App\Models\Placement; @endphp

@props(['items' => null])

@php
    // Загружаем все разделы одним SQL-запросом.
    // Иерархию строим в памяти, без дополнительных запросов к БД.
    $menuItems = $items ?? cache()->remember('menu_tree_optimized_v2', 3600, function () {

        $placements = Placement::query()
            ->select('id', 'parent_id', 'title', 'full_slug', 'order_column')
            ->orderBy('order_column')
            ->get();

        // Группируем разделы по родительскому ID.
        $childrenByParent = $placements->groupBy(
            fn ($placement) => $placement->parent_id ?? 0
        );

        // Рекурсивно собираем дерево из уже загруженных данных.
        $buildTree = function ($parentId) use (&$buildTree, $childrenByParent) {
            return $childrenByParent->get($parentId, collect())
                ->map(function ($item) use (&$buildTree) {
                    $item->setRelation(
                        'children',
                        $buildTree((int) $item->id)
                    );

                    return $item;
                });
        };

        return $buildTree(0);
    });
@endphp

<div class="divide-y divide-sky-100/50">
    @foreach ($menuItems as $item)
        <x-tree-menu-item :item="$item" :level="0"/>
    @endforeach
</div>
