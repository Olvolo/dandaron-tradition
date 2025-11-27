@props(['item', 'isMobile' => false])

@if ($isMobile)
    {{-- Мобильная версия для footer (разворачивается вверх) --}}
    <a href="{{ url($item->full_slug) }}" class="block px-4 py-2 text-sm text-sky-50
    hover:text-sky-100">
        {{ $item->title }}
    </a>
    @if($item->children->where('show_in_menu', true)->isNotEmpty())
        <div class="pl-4">
            @foreach($item->children->where('show_in_menu', true) as $child)
                <a href="{{ url($child->full_slug) }}" class="block px-8 py-1 text-xs
                text-sky-100 hover:text-sky-50">
                    {{ $child->title }}
                </a>
            @endforeach
        </div>
    @endif
@else
    {{-- Десктопная версия для footer (простые ссылки без подменю) --}}
    <a href="{{ url($item->full_slug) }}" class="text-sky-50 hover:text-sky-100 transition-colors">
        {{ $item->title }}
    </a>
@endif
