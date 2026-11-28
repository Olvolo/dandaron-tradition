@props(['content' => null, 'title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $siteName = 'Dandaron Tradition';

        // Название приходит и строкой, и слотом.
        $pageTitle = trim(strip_tags((string) ($title ?? '')));
        $metaTitle = $pageTitle !== '' ? $pageTitle : $siteName;

        $metaDescription = Str::limit(
            trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags(
                $content->annotation
                    ?? 'Dandaron Tradition — онлайн-архив статей и книг, посвящённый работам ряда авторов.'
            ), ENT_QUOTES | ENT_HTML5, 'UTF-8'))),
            160
        );

        $metaImage = !empty($content->background_image_url)
            ? asset($content->background_image_url)
            : null;

        $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG;

        $siteSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $siteName,
            'url' => url('/'),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => url('/search') . '?q={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];

        $pageSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $metaTitle,
            'description' => $metaDescription,
        ];
    @endphp

    <title>{{ $metaTitle === $siteName ? $siteName : $metaTitle . ' | ' . $siteName }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:locale" content="ru_RU">
    @if($metaImage)
        <meta property="og:image" content="{{ $metaImage }}">
    @endif

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="{{ $metaImage ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    @if($metaImage)
        <meta name="twitter:image" content="{{ $metaImage }}">
    @endif

    {{-- Картинка LCP на десктопе: в DOM она стоит после основного контента,
         поэтому браузеру нужна подсказка. Значения должны совпадать с <img>. --}}
    <link rel="preload" as="image" fetchpriority="high"
          media="(min-width: 1280px)"
          imagesrcset="{{ asset('images/biography_materials/dandaron_siddha_aside_434.webp') }} 240w,
                       {{ asset('images/biography_materials/dandaron_siddha_aside_650.webp') }} 480w"
          imagesizes="240px">

    {{-- Микроразметка --}}
    @stack('schema')
    <script type="application/ld+json">{!! json_encode($siteSchema, $jsonFlags) !!}</script>
    <script type="application/ld+json">{!! json_encode($pageSchema, $jsonFlags) !!}</script>

    {{-- Ресурсы (шрифт Noto Serif Tibetan подключается через npm, см. ниже) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Кастомные стили из БД; закрывающий тег style внутри значения исключён --}}
    @if(!empty($content->custom_styles))
        <style>{!! str_ireplace('</style', '<\/style', $content->custom_styles) !!}</style>
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
    @scroll.window="atTop = (window.scrollY < 100)"
    @toc-ready.window="tocAvailable = true"
    class="antialiased font-sans bg-sky-200 text-sky-950 flex flex-col min-h-screen"
    @if(!empty($content->background_image_url))
        style="background-image: url('{{ asset($content->background_image_url) }}');
               background-size: cover;
               background-position: center;
               background-attachment: fixed;"
    @endif
>

@include('layouts.partials.header')

<div class="flex-grow max-w-screen-3xl mx-auto px-2 sm:px-4 md:px-6 pt-24 pb-6">

    <div class="grid grid-cols-1 xl:grid-cols-[minmax(240px,1fr)_minmax(0,4fr)_minmax(240px,1fr)] gap-4 md:gap-6">


        <aside class="hidden xl:block" aria-label="Карта сайта">
            <div id="site-tree-scroll"
     class="sticky top-14 max-h-[calc(100vh-4rem-1.5rem)] overflow-y-auto pr-2">
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
        <main class="w-full">
            <div class="bg-sky-50/10 backdrop-blur-sm rounded-2xl p-2 sm:p-4 border border-sky-300/20">
                {{ $slot }}
            </div>
        </main>
       {{-- Правый сайдбар --}}
        <aside class="hidden xl:block" aria-label="Об авторе и новости">
            <div class="sticky top-14 max-h-[calc(100vh-4rem-1.5rem)] overflow-y-auto pl-2">
                <div class="relative bg-sky-50/10 backdrop-blur-sm rounded-2xl p-4 border border-sky-200/30">

                    {{-- Декоративные элементы --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-sky-200/20 to-transparent rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-sky-300/10 to-transparent rounded-full blur-xl"></div>

                    {{-- Изображение автора --}}
                    <div class="flex justify-center">
                        <figure class="rounded-lg shadow-sm w-full max-w-none">
                            <img
                                src="{{ asset('images/biography_materials/dandaron_siddha_aside_434.webp') }}"
                                srcset="{{ asset('images/biography_materials/dandaron_siddha_aside_434.webp') }} 240w,
                                        {{ asset('images/biography_materials/dandaron_siddha_aside_650.webp') }} 480w"
                                sizes="240px"
                                alt="Дандарон Дхармараджа"
                                width="480"
                                height="660"
                                fetchpriority="high"
                                decoding="async"
                                class="rounded-lg w-full h-auto object-contain"
                            >
                        </figure>
                    </div>

                    {{-- Плашка "Новости сайта" --}}
                    <div class="mt-4">
                        <x-news-widget />
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
    class="fixed bottom-3 left-3 z-40 px-3 py-1.5 text-sm bg-sky-600 text-white rounded-full shadow-lg hover:bg-sky-700"
>
    Содержание
</button>

@include('layouts.partials.footer')

{{-- Кнопка "вверх" --}}
<button x-show="!atTop"
        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        x-transition
        class="fixed bottom-3 right-3 z-40 p-2 bg-sky-600 text-sky-100 rounded-full shadow-lg hover:bg-slate-700 focus:outline-none"
        aria-label="Прокрутить наверх">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 15l7-7 7 7"/>
    </svg>
</button>

<script>
    document.addEventListener('click', function (e) {
        const link = e.target.closest('a[href*="#citation-"], a[href*="#ref-"]');
        if (!link) return;

        const url = new URL(link.href, window.location.href);

        if (url.pathname === window.location.pathname) {
            const target = document.querySelector(url.hash);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'auto', block: 'start' });
                history.pushState(null, '', url.hash);
            }
        }

    });

    window.addEventListener('load', function () {
        if (window.location.hash) {
            const target = document.querySelector(window.location.hash);
            if (target) {
                setTimeout(function () {
                    target.scrollIntoView({ behavior: 'auto', block: 'start' });
                }, 150);
            }
        }
    });
</script>

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

        <template x-if="mobileLeftSidebar">
            <div>
                <x-tree-menu />
            </div>
        </template>
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
<script>
(() => {
    const key = 'site-tree-scroll-position';

    // Сохраняем положение меню перед переходом.
    document.addEventListener('click', (event) => {
        const link = event.target.closest('#site-tree-scroll a[href]');

        if (!link) return;

        const url = new URL(link.href, window.location.href);

        if (
            url.origin === window.location.origin &&
            !event.ctrlKey &&
            !event.metaKey &&
            !event.shiftKey &&
            !event.altKey &&
            event.button === 0
        ) {
            const container = document.getElementById('site-tree-scroll');

            if (container) {
                sessionStorage.setItem(key, container.scrollTop);
            }
        }
    });

    // Восстанавливаем положение после инициализации Alpine.js.
    document.addEventListener('alpine:initialized', () => {
        const container = document.getElementById('site-tree-scroll');
        const savedPosition = sessionStorage.getItem(key);

        if (!container || savedPosition === null) return;

        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                container.scrollTop = Number(savedPosition);
                sessionStorage.removeItem(key);
            });
        });
    }, { once: true });

})();
</script>
</body>
</html>
