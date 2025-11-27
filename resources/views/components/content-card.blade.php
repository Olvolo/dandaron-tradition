@props(['item'])
@php
    // Определяем, что за контент нам передали, и получаем нужные данные
    $displayItem = $item->placementable ?? $item;
    $url = url($item->full_slug ?? '#');
    $type = match($item->placementable_type) {
        'App\\Models\\Article' => 'Статья',
        'App\\Models\\Book' => 'Книга',
        default => 'Раздел',
    };
@endphp

<a href="{{ $url }}" class="content-card group">
    <h3>
        <span class="line-clamp-3">{{ $displayItem->title }}</span>
    </h3>
    <p class="card-type">
        {{ $type }}
    </p>
</a>
