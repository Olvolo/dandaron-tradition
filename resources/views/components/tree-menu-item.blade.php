@props(['item', 'level' => 0])
@php
    $children = $item->children ?? collect();
    $hasChildren = $children->isNotEmpty();

    $currentPath = trim(request()->path(), '/');
    $itemPath = trim($item->full_slug, '/');

    $isActive = ($currentPath === $itemPath);

    if ($itemPath === '') {
        $isAncestorOfActive = ($currentPath !== '');
    } else {
        $isAncestorOfActive = str_starts_with($currentPath, $itemPath . '/');
    }

    $isExpanded = $isActive || $isAncestorOfActive;
    $paddingLeft = 0.25 + ($level * 0.75);

    $persistKey = 'menu-' . ($itemPath ?: 'home');
    $openState = $isExpanded ? 'true' : 'false';
@endphp

<div x-data="{ open: $persist({{ $openState }}).as('{{ $persistKey }}')}" class="py-1 border-b
border-sky-300 last:border-b">
    <div class="flex items-center group hover:bg-sky-100/80 rounded-lg transition-all duration-200"
         style="padding-left: {{ $paddingLeft }}rem">

        {{-- Стрелка --}}
        @if($hasChildren)
            <button @click.stop="open = !open" class="p-1.5 rounded-md hover:bg-sky-200/60 transition-colors">
                <svg class="w-4 h-4 text-sky-600 transition-transform" :class="open ? 'rotate-90' : ''" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        @else
            <span class="w-7 flex-shrink-0"></span>
        @endif

        {{-- Ссылка --}}
        <a href="{{ $item->full_slug === '' ? url('/') : url($item->full_slug) }}"
           class="flex-1 py-2 px-2 text-xs rounded-md transition-all duration-200
                  {{ $isActive ? 'text-sky-900 font-semibold bg-sky-200/50 shadow-sm' : 'text-sky-700 hover:text-sky-900 hover:bg-sky-200/50' }}"
           style="min-width: 0;">
            <span class="block whitespace-normal break-words">{{ $item->title }}</span>
        </a>

        {{-- Счётчик детей --}}
        @if($hasChildren)
            <span class="text-xs font-medium text-sky-500 opacity-70 px-2.5 py-1 rounded-full bg-sky-200/50 mr-1.5">
                {{ $children->count() }}
            </span>
        @endif
    </div>

    {{-- ВЛОЖЕННОСТЬ --}}
    @if($hasChildren)
        <div x-show="open" x-collapse class="space-y-0.5 mt-0.5">
            @foreach($children as $child)
                <x-tree-menu-item :item="$child" :level="$level + 1" />
            @endforeach
        </div>
    @endif
</div>
