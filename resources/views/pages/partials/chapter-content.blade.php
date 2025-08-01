{{-- Устанавливаем отступ в зависимости от уровня вложенности --}}
@php
    $padding = ($level ?? 0) * 2;
    $headingLevel = 2 + ($level ?? 0);
@endphp

<div style="padding-left: {{ $padding }}rem;" class="mt-8">
    {{-- Выводим заголовок главы соответствующего уровня (h2, h3, h4...) --}}
    {!! "<h".$headingLevel." class=\"text-2xl font-bold mb-4\">" !!}
    {{ $chapter->title }}
    {!! "</h".$headingLevel.">" !!}

    {{-- Выводим HTML-контент главы --}}
    <div class="prose prose-lg max-w-none">
        {!! $chapter->content_html !!}
    </div>
</div>

{{-- Рекурсивно вызываем этот же шаблон для всех дочерних глав --}}
@if($chapter->children->isNotEmpty())
    @foreach($chapter->children as $child)
        @include('pages.partials.chapter-content', ['chapter' => $child, 'level' => ($level ?? 0) + 1])
    @endforeach
@endif
