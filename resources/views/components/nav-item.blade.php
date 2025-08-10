{{-- Этот шаблон будет отвечать за один пункт меню и его дочерние элементы --}}
{{--<li class="relative group">--}}
{{--    <a href="{{ url($item->full_slug) }}" class="hover:text-amber-600" wire:navigate>{{ $item->title }}</a>--}}

{{--    --}}{{-- Если есть дочерние элементы, создаём вложенный список --}}
{{--    @if($item->childrenRecursive->isNotEmpty())--}}
{{--        <ul class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2 invisible group-hover:visible transition-all duration-200">--}}
{{--            @foreach($item->childrenRecursive as $child)--}}
{{--                --}}{{-- И для каждого дочернего элемента снова вызываем этот же шаблон --}}
{{--                @include('layouts.partials.nav-item', ['item' => $child])--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    @endif--}}
{{--</li>--}}

@props(['item', 'isMobile' => false])

@if ($isMobile)
    {{-- Версия для мобильного меню --}}
    <a href="{{ url($item->full_slug) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $item->title }}</a>
    {{-- Показываем детей только если они есть И помечены как показывать в меню --}}
    @if($item->children->where('show_in_menu', true)->isNotEmpty())
        <div class="pl-4">
            @foreach($item->children->where('show_in_menu', true) as $child)
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
        {{-- Показываем детей только если они есть И помечены как показывать в меню --}}
        @if($item->children->where('show_in_menu', true)->isNotEmpty())
            <div x-show="open"
                 x-transition
                 class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg z-20"
                 x-cloak>
                <div class="py-1">
                    @foreach($item->children->where('show_in_menu', true) as $child)
                        <x-nav-item :item="$child" :is-mobile="true" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endif
