@props(['item', 'isMobile' => false])

@if ($isMobile)
    {{-- Мобильная версия для header --}}
    <a href="{{ url($item->full_slug) }}" class="block px-4 py-2 text-sm text-sky-800 hover:bg-sky-200">
        {{ $item->title }}
    </a>
    @if($item->children->where('show_in_menu', true)->isNotEmpty())
        <div class="pl-4">
            @foreach($item->children->where('show_in_menu', true) as $child)
                <x-header-nav-item :item="$child" :is-mobile="true" />
            @endforeach
        </div>
    @endif
@else
    {{-- Десктопная версия для header --}}
    <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
        <a href="{{ url($item->full_slug) }}"
           @mouseover="open = true"
           class="text-sky-800 font-medium hover:text-sky-600 transition-colors">
            {{ $item->title }}
        </a>
        @if($item->children->where('show_in_menu', true)->isNotEmpty())
            <div x-show="open"
                 x-transition
                 class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg border z-20"
                 x-cloak>
                <div class="py-1">
                    @foreach($item->children->where('show_in_menu', true) as $child)
                        <a href="{{ url($child->full_slug) }}" class="block px-4 py-2 text-sm text-sky-800 hover:bg-sky-200">
                            {{ $child->title }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endif
