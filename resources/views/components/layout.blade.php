@props(['content' => null])

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dandaron Tradition' }}</title>
    <meta name="description" content="{{ $description ?? 'Онлайн-архив статей и книг, посвящённый работам ряда авторов.' }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Блок для инъекции кастомных стилей --}}
    @if($content && $content->custom_styles)
        <style>
            {!! $content->custom_styles !!}
        </style>
    @endif
</head>
{{-- Alpine.js для кнопки "Наверх" и новая Flexbox-структура для "липкого" футера --}}
<body
    x-data="{ atTop: true }" @scroll.window="atTop = (window.scrollY < 100)"
    class="antialiased font-sans bg-gray-100 text-gray-900 flex flex-col min-h-screen"
    {{-- Блок для установки фона страницы --}}
    @if($content && property_exists($content, 'background_image_url') && $content->background_image_url)
        style="background-image: url('{{ asset($content->background_image_url) }}'); background-size: cover; background-position: center; background-attachment: fixed;"
    @endif
>

@include('layouts.partials.header')

{{-- Основной контент, который теперь будет "растягиваться", прижимая футер к низу --}}
<main class="flex-grow container mx-auto p-4 md:p-6">
    {{ $slot }}
</main>

@include('layouts.partials.footer')

{{-- ВОЗВРАЩАЕМ КНОПКУ "НАВЕРХ" --}}
<button
    x-show="!atTop"
    @click="window.scrollTo({top: 0, behavior: 'smooth'})"
    x-transition
    class="fixed bottom-5 right-5 z-40 p-3 bg-sky-600 text-white rounded-full shadow-lg hover:bg-slate-700 focus:outline-none"
    aria-label="Прокрутить наверх">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
</button>

</body>
</html>
