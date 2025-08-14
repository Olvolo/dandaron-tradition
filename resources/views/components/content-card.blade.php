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

{{--
    - h-48: Задает фиксированную высоту карточке
    - flex, flex-col, items-center, justify-center: Центрируют содержимое по вертикали и горизонтали
    - bg-white/30 backdrop-blur-sm border border-white/40: Создают эффект "матового стекла"
    - hover:bg-white/50 hover:shadow-xl: Эффекты при наведении
--}}
<a href="{{ $url }}"
   class="h-48 p-4 rounded-2xl group transition-all duration-300
          bg-sky-100/30 backdrop-blur-sm border border-sky-100/40
          hover:bg-sky-100/50 hover:shadow-xl
          flex flex-col items-center justify-center text-center">

    <h3 class="font-bold text-2xl text-sky-950 group-hover:text-sky-800 transition-colors">
        {{ $displayItem->title }}
    </h3>

    <p class="text-xs text-sky-800 mt-2 uppercase tracking-wider">
        {{ $type }}
    </p>
</a>
