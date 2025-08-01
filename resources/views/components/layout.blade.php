{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}

{{--    --}}{{-- Теперь title будет динамическим, с запасным вариантом по умолчанию --}}
{{--    <title>@yield('title', 'Dandaron Tradition')</title>--}}

{{--    --}}{{-- Добавляем динамическое описание --}}
{{--    <meta name="description" content="@yield('description', 'Онлайн-архив статей и книг, посвящённый работам ряда авторов.')">--}}

{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
{{--    @stack('styles')--}}
{{--</head>--}}
{{--<body class="bg-gray-100 text-gray-800">--}}
{{--<div x-data="{ atTop: true }" @scroll.window="atTop = (window.scrollY < 100)">--}}

{{--    @include('layouts.partials.header')--}}

{{--    <main class="container mx-auto p-4 my-6">--}}
{{--        {{ $slot }}--}}
{{--    </main>--}}

{{--    @include('layouts.partials.footer') --}}{{-- <-- Я добавил footer в отдельный файл для порядка --}}

{{--    --}}{{-- ВАШ КОД КНОПКИ "ВВЕРХ" --}}
{{--    <button--}}
{{--        x-show="!atTop"--}}
{{--        @click="window.scrollTo({top: 0, behavior: 'smooth'})"--}}
{{--        x-transition--}}
{{--        class="fixed bottom-5 right-5 z-40 p-3 bg-sky-600 text-white rounded-full shadow-lg--}}
{{--        hover:bg-slate-700 focus:outline-none"--}}
{{--        aria-label="Прокрутить наверх"--}}
{{--    >--}}
{{--        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>--}}
{{--    </button>--}}

{{--</div> --}}{{-- Конец обертки x-data --}}
{{--</body>--}}
{{--</html>--}}

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Dandaron Tradition' }}</title>
    <meta name="description" content="{{ $description ?? 'Онлайн-архив статей и книг, посвящённый работам ряда авторов.' }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-100 text-gray-800">
<div x-data="{ atTop: true }" @scroll.window="atTop = (window.scrollY < 100)">

    @include('layouts.partials.header')

    <main class="container mx-auto p-4 my-6">
        {{ $slot }}
    </main>

    @include('layouts.partials.footer')

    <button
        x-show="!atTop"
        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        x-transition
        class="fixed bottom-5 right-5 z-40 p-3 bg-sky-600 text-white rounded-full shadow-lg
        hover:bg-slate-700 focus:outline-none"
        aria-label="Прокрутить наверх"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
    </button>

</div>
</body>
</html>
