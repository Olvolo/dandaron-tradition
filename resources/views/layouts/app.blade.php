    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Кастомные стили из переменной $custom_styles --}}
    @if(!empty($custom_styles))
        <style>
            {!! $custom_styles !!}
        </style>
    @endif

    {{-- Кастомные стили из объекта $content --}}
    @if(!empty($content->custom_styles))
        <style>
            {!! $content->custom_styles !!}
        </style>
    @endif
</head>
<body class="font-sans antialiased"
      {{-- Фоновое изображение --}}
      @if(!empty($content->background_image_url))
          style="background-image: url('{{ asset($content->background_image_url) }}'); background-size: cover; background-position: center; background-attachment: fixed;"
    @endif
>
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
