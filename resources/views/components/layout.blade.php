@props(['content' => null])

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dandaron Tradition' }}</title>
    <meta name="description" content="{{ $content->annotation ?? 'Dandaron Tradition - онлайн-архив статей и книг, посвящённый работам ряда авторов.' }}">

    <meta name="description" content="{{ $description ?? 'Онлайн-архив статей и книг, посвящённый работам ряда авторов.' }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Кастомные стили --}}
    @if(!empty($content->custom_styles))
        <style>
            {!! $content->custom_styles !!}
        </style>
    @endif
</head>
<body
    x-data="{ atTop: true }" @scroll.window="atTop = (window.scrollY < 100)"
    class="antialiased font-sans bg-sky-200 text-sky-950 flex flex-col min-h-screen"
    {{-- Фоновое изображение через inline стили --}}
    @if(!empty($content->background_image_url))
        style="background-image: url('{{ asset($content->background_image_url) }}'); background-size: cover; background-position: center; background-attachment: fixed;"
    @endif
>

@include('layouts.partials.header')

<main class="flex-grow max-w-screen-3xl mx-auto p-4 md:p-6 pt-24">
    {{ $slot }}
</main>

@include('layouts.partials.footer')

<button
    x-show="!atTop"
    @click="window.scrollTo({top: 0, behavior: 'smooth'})"
    x-transition
    class="fixed bottom-5 right-5 z-40 p-3 bg-sky-600 text-sky-100 rounded-full shadow-lg
    hover:bg-slate-700 focus:outline-none"
    aria-label="Прокрутить наверх">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
</button>

</body>
</html>
