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

<a href="{{ $url }}"
   class="h-full p-4 rounded-2xl group transition-all duration-300
          bg-sky-100/30 backdrop-blur-sm border border-sky-100/40
          hover:bg-sky-100/50 hover:shadow-xl
          flex flex-col items-center justify-center text-center">
    <h3 class="font-bold text-2xl text-sky-950 group-hover:text-sky-800 transition-colors flex-1 flex items-center">
        <span class="line-clamp-3">{{ $displayItem->title }}</span>
    </h3>
    <p class="text-xs text-sky-800 mt-2 uppercase tracking-wider flex-shrink-0">
        {{ $type }}
    </p>
</a>
