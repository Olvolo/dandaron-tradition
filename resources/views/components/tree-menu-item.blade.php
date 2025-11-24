@props(['item', 'level' => 0])

@php
    $children = $item->children ?? collect();
    $hasChildren = $children->isNotEmpty();

    $currentPath = trim(request()->path(), '/');
    $itemPath = trim($item->full_slug, '/');

    $isActive = $currentPath === $itemPath;
    // Проверяем, является ли текущий путь дочерним для этого элемента
    $isAncestorOfActive = $itemPath !== '' && str_starts_with($currentPath, $itemPath . '/');
    $isExpanded = $isActive || $isAncestorOfActive;

    $paddingLeft = 0.5 + ($level * 1);
    $itemId = 'menu-item-' . $item->id;
@endphp

<div x-data="{
    open: @js($isExpanded),
    itemId: '{{ $itemId }}',
    init() {
        const saved = localStorage.getItem(this.itemId);
        if (saved !== null) {
            this.open = saved === 'true';
        }
        if (@js($isAncestorOfActive)) {
            this.open = true;
            localStorage.setItem(this.itemId, 'true');
        }
    },
    toggle() {
        this.open = !this.open;
        localStorage.setItem(this.itemId, this.open.toString());
    }
}">
    <div class="flex items-center group hover:bg-sky-100/80 rounded-lg transition-all duration-200"
         style="padding-left: {{ $paddingLeft }}rem">

        {{-- Стрелка --}}
        @if($hasChildren)
            <button
                @click.stop="toggle()"
                class="p-1.5 rounded-md hover:bg-sky-200/60 transition-colors"
                type="button"
                aria-label="Развернуть подменю"
                :aria-expanded="open.toString()">
                <svg class="w-4 h-4 text-sky-600 transition-transform duration-200"
                     :class="open ? 'rotate-90' : ''"
                     viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        @else
            <span class="w-7 flex-shrink-0"></span>
        @endif

        {{-- Ссылка --}}
        <a href="{{ $item->full_slug === '' ? url('/') : url($item->full_slug) }}"
           class="flex-1 py-2.5 px-3 text-sm rounded-md transition-all duration-200
                  {{ $isActive
                     ? 'text-sky-900 font-semibold bg-sky-200/50 shadow-sm'
                     : 'text-sky-700 hover:text-sky-900 hover:bg-sky-50/50' }}"
            {{ $isActive ? 'aria-current=page' : '' }}>
            <span class="block truncate">{{ $item->title }}</span>
        </a>

        {{-- Счётчик детей --}}
        @if($hasChildren)
            <span class="text-xs font-medium text-sky-500 opacity-70 px-2.5 py-1 rounded-full bg-sky-100/50 mr-1.5">
                {{ $children->count() }}
            </span>
        @endif
    </div>

    {{-- Вложенность --}}
    @if($hasChildren)
        <div x-show="open"
             x-collapse
             style="display: {{ $isExpanded ? 'block' : 'none' }};"
             class="space-y-0.5 mt-0.5">
            @foreach($children as $child)
                <x-tree-menu-item :item="$child" :level="$level + 1" />
            @endforeach
        </div>
    @endif
</div>
