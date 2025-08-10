@props(['item', 'isMobile' => false])

@if ($isMobile)
    {{-- Версия для мобильного меню --}}
    <a href="{{ url($item->full_slug) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $item->title }}</a>
    @if($item->children->isNotEmpty())
        <div class="pl-4">
            @foreach($item->children as $child)
                <x-nav-item :item="$child" :is-mobile="true" />
            @endforeach
        </div>
    @endif
@else
    {{-- Версия для десктопа с выпадающим меню --}}
    <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
        <a href="{{ url($item->full_slug) }}" @mouseover="open = true" class="hover:text-sky-600 transition-colors">
            {{ $item->title }}
        </a>
        @if($item->children->isNotEmpty())
            <div x-show="open"
                 x-transition
                 class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg z-20"
                 x-cloak>
                <div class="py-1">
                    @foreach($item->children as $child)
                        <x-nav-item :item="$child" :is-mobile="true" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endif
