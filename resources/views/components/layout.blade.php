@php@endphp
@props(['content' => null])

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Dandaron Tradition' }}</title>

    <meta name="description"
          content="{{ $content->annotation ?? 'Dandaron Tradition - онлайн-архив статей и книг, посвящённый работам ряда авторов.' }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Кастомные стили --}}
    @if(!empty($content->custom_styles))
        <style>{!! $content->custom_styles !!}</style>
    @endif
</head>

<body
    x-data="{
        atTop: true,
        mobileLeftSidebar: false,
        mobileRightSidebar: false
    }"
    @scroll.window="atTop = (window.scrollY < 100)"
    class="antialiased font-sans bg-sky-200 text-sky-950 flex flex-col min-h-screen"
    @if(!empty($content->background_image_url))
        style="background-image: url('{{ asset($content->background_image_url) }}');
               background-size: cover;
               background-position: center;
               background-attachment: fixed;"
    @endif
>

@include('layouts.partials.header')

<div class="flex-grow max-w-screen-3xl mx-auto px-4 md:px-6 pt-24 pb-6">
    <div class="grid grid-cols-1 xl:grid-cols-[minmax(240px,1fr)_minmax(0,2fr)_minmax(240px,1fr)] gap-4 md:gap-6">

        <aside class="hidden xl:block">
            <div class="sticky top-14 max-h-[calc(100vh-4rem-1.5rem)] overflow-y-auto pr-2">
                <div class="bg-gradient-to-br from-sky-50/90 via-white/80 to-sky-50/90
            backdrop-blur-xl border border-sky-200/60
            rounded-2xl shadow-lg shadow-sky-200/30
            p-4 relative overflow-hidden">

                    {{-- Декоративные элементы --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-sky-200/20 to-transparent rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-sky-300/10 to-transparent rounded-full blur-xl"></div>

                    {{-- Меню --}}
                    <div class="relative pt-8">
                        <x-tree-menu />
                    </div>
                </div>
            </div>
        </aside>

        {{-- Основной контент --}}
        <main>
            <div class="bg-sky-50/10 backdrop-blur-sm rounded-2xl p-4 border border-sky-300/20">
                {{ $slot }}
            </div>
        </main>
        {{-- Правый сайдбар --}}
        <aside class="hidden xl:block">
            <div class="sticky top-14 max-h-[calc(100vh-4rem-1.5rem)] overflow-y-auto pl-2">
                <div class="bg-sky-50/10 backdrop-blur-sm rounded-2xl p-4 border border-sky-200/30">

                    {{-- Декоративные элементы --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-sky-200/20 to-transparent rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-sky-300/10 to-transparent rounded-full blur-xl"></div>

                    {{-- Изображение автора --}}
                    <div class="flex justify-center">
                        <figure class="rounded-lg shadow-sm w-full max-w-none">
                            <img
                                src="{{ asset('images/authors/dandaron_dharmaraja_right_sidebar.webp') }}"
                                alt="Дандарон Дхармараджа"
                                class="rounded-lg w-full h-auto object-contain"
                            >
                        </figure>
                    </div>
                </div>
            </div>
        </aside>

    </div>
</div>

@include('layouts.partials.footer')

{{-- Кнопка "вверх" --}}
<button x-show="!atTop"
        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        x-transition
        class="fixed bottom-5 right-5 z-40 p-3 bg-sky-600 text-sky-100 rounded-full shadow-lg hover:bg-slate-700 focus:outline-none"
        aria-label="Прокрутить наверх">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 15l7-7 7 7"/>
    </svg>
</button>

{{-- Мобильная левая панель --}}
<div
    x-show="mobileLeftSidebar"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click.self="mobileLeftSidebar = false"
    @keydown.escape.window="mobileLeftSidebar = false"
    class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm xl:hidden"
    style="display: none;"
>
    <div
        x-show="mobileLeftSidebar"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="absolute left-0 top-0 h-full w-72 bg-sky-50 shadow-xl p-4 overflow-y-auto"
    >
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-sky-900">Карта сайта</h3>
            <button
                @click="mobileLeftSidebar = false"
                class="p-2 hover:bg-sky-200 rounded-md transition-colors"
                aria-label="Закрыть меню"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <x-tree-menu />
    </div>
</div>

{{-- Мобильная правая панель --}}
<div
    x-show="mobileRightSidebar"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click.self="mobileRightSidebar = false"
    @keydown.escape.window="mobileRightSidebar = false"
    class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm xl:hidden"
    style="display: none;"
>
    <div
        x-show="mobileRightSidebar"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="absolute right-0 top-0 h-full w-72 bg-sky-50 shadow-xl p-4 overflow-y-auto"
    >
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-sky-900">Врата</h3>
            <button
                @click="mobileRightSidebar = false"
                class="p-2 hover:bg-sky-200 rounded-md transition-colors"
                aria-label="Закрыть панель"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        @guest
            <a href="{{ route('login') }}" class="block py-2 text-sky-900 hover:bg-sky-200 rounded px-2 transition-colors">Вход</a>
            <a href="{{ route('register') }}" class="block py-2 text-sky-900 hover:bg-sky-200 rounded px-2 transition-colors">Регистрация</a>
        @endguest

        @auth
            <a href="{{ route('dashboard') }}" class="block py-2 text-sky-900 hover:bg-sky-200 rounded px-2 transition-colors">Личный кабинет</a>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button class="w-full text-left py-2 px-2 text-sky-900 hover:bg-sky-200 rounded transition-colors">Выход</button>
            </form>
        @endauth
    </div>
</div>

</body>
</html>
