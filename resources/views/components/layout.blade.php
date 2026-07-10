@props([
    'content' => null,
    'title' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Заголовок --}}
    <title>{{ $title ? $title . ' | Dandaron Tradition' : 'Dandaron Tradition' }}</title>

    {{-- SEO --}}
    <meta name="description"
          content="{{ Str::limit(strip_tags($content->annotation ?? 'Dandaron Tradition — онлайн-архив трудов и переводов, посвящённый наследию Бидии Дандарона, работам и переводам его учеников, соратников и последователей.'),160) }}">

    <link rel="canonical" href="{{ url()->current() }}">

    @if(request()->has('q') || request()->has('page'))
        <meta name="robots" content="noindex,follow">
    @endif

    {{-- OpenGraph --}}
    <meta property="og:title" content="{{ $title ?? 'Dandaron Tradition' }}">
    <meta property="og:description"
          content="{{ Str::limit(strip_tags($content->annotation ?? 'Архив трудов...'),160) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Dandaron Tradition">

    @if(!empty($content->background_image_url))
        <meta property="og:image" content="{{ asset($content->background_image_url) }}">
    @endif

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'Dandaron Tradition' }}">
    <meta name="twitter:description"
          content="{{ Str::limit(strip_tags($content->annotation ?? 'Архив трудов...'),160) }}">

    @if(!empty($content->background_image_url))
        <meta name="twitter:image" content="{{ asset($content->background_image_url) }}">
    @endif

    {{-- Страницы сами добавляют свою Schema.org --}}
    @stack('schema')

    {{-- Schema.org сайта --}}
    <script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => 'Dandaron Tradition',
    'url' => url('/'),
    'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => url('/search').'?q={search_term_string}',
        'query-input' => 'required name=search_term_string',
    ],
], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
    </script>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Tibetan&display=swap"
          rel="stylesheet">

    @if(!empty($content->custom_styles))
        <style>{!! $content->custom_styles !!}</style>
    @endif
</head>

<body
    x-data="{
        atTop: true,
        mobileLeftSidebar: false,
        mobileRightSidebar: false,
        tocAvailable: false,
        tocOpen: false
    }"
    x-on:scroll.window="atTop = window.scrollY < 100"
    x-on:toc-ready.window="tocAvailable = true"
    class="antialiased font-sans bg-sky-200 text-sky-950 flex flex-col min-h-screen"
    @if(!empty($content->background_image_url))
        style="background-image:url('{{ asset($content->background_image_url) }}');
               background-size:cover;
               background-position:center;
               background-attachment:fixed;"
    @endif
>

@include('layouts.partials.header')

    <div class="flex-grow max-w-screen-3xl mx-auto px-2 sm:px-4 md:px-6 pt-24 pb-6">
    <div class="grid grid-cols-1 xl:grid-cols-[minmax(240px,1fr)_minmax(0,4fr)_minmax(240px,1fr)] gap-4 md:gap-6">
        {{-- Левый сайдбар --}}
        <aside class="hidden xl:block">
            <div class="sticky top-14 max-h-[calc(100vh-4rem-1.5rem)] overflow-y-auto pr-2">

                <div class="bg-gradient-to-br
                            from-sky-50/90
                            via-white/80
                            to-sky-50/90
                            backdrop-blur-xl
                            border border-sky-200/60
                            rounded-2xl
                            shadow-lg shadow-sky-200/30
                            p-4
                            relative
                            overflow-hidden">

                    {{-- Декоративные элементы --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-sky-200/20 to-transparent rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-sky-300/10 to-transparent rounded-full blur-xl"></div>

                    <div class="relative pt-8">
                        <x-tree-menu />
                    </div>

                </div>
            </div>
        </aside>

        {{-- Основной контент --}}
        <main class="w-full">
            <div class="bg-sky-50/10
                        backdrop-blur-sm
                        rounded-2xl
                        p-2 sm:p-4
                        border border-sky-300/20">

                {{ $slot }}

            </div>
        </main>

        {{-- Правая колонка --}}
        <aside class="hidden xl:block">
            <div class="sticky top-14 max-h-[calc(100vh-4rem-1.5rem)] overflow-y-auto pl-2">

                <div class="bg-sky-50/10
                            backdrop-blur-sm
                            rounded-2xl
                            p-4
                            border border-sky-200/30
                            relative
                            overflow-hidden">

                    {{-- Декоративные элементы --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-sky-200/20 to-transparent rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-sky-300/10 to-transparent rounded-full blur-xl"></div>

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
{{-- Кнопка "Содержание" --}}
<button
    x-show="tocAvailable"
    @click="window.dispatchEvent(new CustomEvent('open-toc'))"
    x-transition
    class="fixed bottom-5 left-5 z-40 px-4 py-2 bg-sky-600 text-white rounded-full shadow-lg hover:bg-sky-700">
    Содержание
</button>

@include('layouts.partials.footer')

{{-- Кнопка "Наверх" --}}
<button
    x-show="!atTop"
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    x-transition
    class="fixed bottom-5 right-5 z-40 p-3 bg-sky-600 text-sky-100 rounded-full shadow-lg hover:bg-slate-700 focus:outline-none"
    aria-label="Прокрутить наверх">

    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M5 15l7-7 7 7"/>
    </svg>

</button>

{{-- Мобильное меню --}}
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
    style="display:none"
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
                class="p-2 hover:bg-sky-200 rounded-md transition-colors">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>

            </button>
        </div>

        <x-tree-menu />

    </div>

</div>

{{-- Правая мобильная панель --}}
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
    style="display:none"
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
                class="p-2 hover:bg-sky-200 rounded-md transition-colors">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>

            </button>

        </div>

        @guest
            <a href="{{ route('login') }}"
               class="block py-2 px-2 text-sky-900 hover:bg-sky-200 rounded">
                Вход
            </a>

            <a href="{{ route('register') }}"
               class="block py-2 px-2 text-sky-900 hover:bg-sky-200 rounded">
                Регистрация
            </a>
        @endguest

        @auth

            <a href="{{ route('dashboard') }}"
               class="block py-2 px-2 text-sky-900 hover:bg-sky-200 rounded">
                Личный кабинет
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf

                <button
                    class="w-full text-left py-2 px-2 text-sky-900 hover:bg-sky-200 rounded">
                    Выход
                </button>

            </form>

        @endauth

    </div>

</div>

</body>
</html>
