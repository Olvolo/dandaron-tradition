<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- В будущем здесь будет title страницы --}}
    <title>Dandaron Tradition</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
{{-- Здесь будет шапка с навигацией --}}
@include('layouts.partials.header')

<main class="container mx-auto p-4 my-6">
    {{ $slot }}
</main>

{{-- Здесь будет подвал --}}
<footer class="bg-white shadow-inner mt-8">
    <div class="container mx-auto p-4 text-center text-gray-600">
        <p>&copy; {{ date('Y') }} Dandaron Tradition. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
