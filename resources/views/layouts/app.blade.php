<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @if (!empty($custom_styles))
            <style>
                {!! $custom_styles !!}
            </style>
        @endif
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.partials.header')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @if(request()->has('q'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const urlParams = new URLSearchParams(window.location.search);
                    const searchQuery = urlParams.get('q');

                    if (searchQuery) {
                        // Добавляем параметр ко всем ссылкам, кроме исключений
                        document.querySelectorAll('a[href^="/"]').forEach(link => {
                            try {
                                // Исключаем ссылки с определёнными классами или атрибутами
                                if (link.classList.contains('no-search-param') ||
                                    link.hasAttribute('data-no-search')) {
                                    return;
                                }

                                const linkUrl = new URL(link.href, window.location.origin);
                                if (!linkUrl.searchParams.has('q') &&
                                    !linkUrl.hash &&
                                    linkUrl.pathname !== '/') {
                                    linkUrl.searchParams.set('q', searchQuery);
                                    link.href = linkUrl.toString();
                                }
                            } catch(e) {
                                console.error('Error processing link:', link.href);
                            }
                        });
                    }
                });
            </script>
        @endif
    </body>
</html>
