@props([
    'items' => null,
    'placement' => null,
])

@php
if ($placement) {
    $items = [
        [
            'title' => 'Главная',
            'url' => url('/'),
        ],
    ];

    foreach ($placement->getAncestors() as $ancestor) {
        if ($ancestor->full_slug !== '') {
            $items[] = [
                'title' => $ancestor->title,
                'url' => url($ancestor->full_slug),
            ];
        }
    }

    $items[] = [
        'title' => $placement->title,
    ];
}
@endphp

<nav class="text-sm text-sky-700 mb-4" aria-label="Хлебные крошки">
    <ol class="flex flex-wrap gap-2">
        @foreach($items as $index => $item)
            <li class="flex items-center gap-2">
                @if($index > 0)
                    <span class="text-sky-400" aria-hidden="true">/</span>
                @endif
                @if(isset($item['url']))
                    <a href="{{ $item['url'] }}" class="hover:text-amber-600 transition-colors">
                        {{ $item['title'] }}
                    </a>
                @else
                    <span class="text-sky-900 font-medium">{{ $item['title'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
