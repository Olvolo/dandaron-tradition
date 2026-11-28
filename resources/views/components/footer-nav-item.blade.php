@props(['item', 'isMobile' => false])

@if ($isMobile)
    {{-- Мобильная версия для footer --}}
    <a href="{{ url($item->full_slug) }}"
       class="block px-3 py-1.5 text-sm text-sky-950 hover:text-sky-700 transition-colors">
        {{ $item->title }}
    </a>

    @if($item->children->where('show_in_menu', true)->isNotEmpty())
        <div class="pl-3">
            @foreach($item->children->where('show_in_menu', true) as $child)
                <a href="{{ url($child->full_slug) }}"
                   class="block px-6 py-1 text-xs text-sky-900 hover:text-sky-700 transition-colors">
                    {{ $child->title }}
                </a>
            @endforeach
        </div>
    @endif
@else
    {{-- Десктопная версия --}}
    <a href="{{ url($item->full_slug) }}"
       class="text-sky-950 hover:text-sky-700 transition-colors leading-none">
        {{ $item->title }}
    </a>
@endif
