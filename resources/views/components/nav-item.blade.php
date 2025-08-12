@props(['item', 'isMobile' => false, 'inFooter' => false])

@if ($isMobile)
    {{-- Версия для мобильного меню --}}
    <a href="{{ url($item->full_slug) }}" class="block px-2 py-2 text-sm text-sky-800
    hover:bg-sky-200">{{ $item->title }}</a>
    {{-- Показываем детей только если они есть И помечены как показывать в меню --}}
    @if($item->children->where('show_in_menu', true)->isNotEmpty())
        <div class="pl-2">
            @foreach($item->children->where('show_in_menu', true) as $child)
                <x-nav-item :item="$child" :is-mobile="true" :in-footer="$inFooter" />
            @endforeach
        </div>
    @endif
@else
    {{-- Версия для десктопа с выпадающим меню --}}
    <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
        <a href="{{ url($item->full_slug) }}"
           @mouseover="open = true"
           class="{{ $inFooter ? 'text-sky-100 hover:text-sky-200' : 'text-sky-800 font-semibold hover:text-sky-600' }} transition-colors">
            {{ $item->title }}
        </a>
        {{-- Показываем детей только если они есть И помечены как показывать в меню --}}
        @if($item->children->where('show_in_menu', true)->isNotEmpty())
            <div x-show="open"
                 x-transition
                 class="absolute {{ $inFooter ? 'bottom-full mb-2' : 'left-0 mt-2' }} w-56 bg-sky-300 rounded-md shadow-lg z-20"
                 x-cloak>
                <div class="py-1">
                    @foreach($item->children->where('show_in_menu', true) as $child)
                        <x-nav-item :item="$child" :is-mobile="true" :in-footer="$inFooter" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endif
