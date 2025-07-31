<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-slate-100 text-slate-900">
<div class="flex">
    <aside class="w-64 bg-slate-800 text-white p-4 min-h-screen">
        <h2 class="font-bold text-lg mb-4">Dandaron Tradition</h2>
        <nav class="flex flex-col space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:bg-slate-700 rounded p-2">Главная</a>
            <a href="{{ route('admin.structure.index') }}" class="hover:bg-slate-700 rounded p-2">Структура сайта</a>
            <a href="{{ route('admin.articles.index') }}" class="hover:bg-slate-700 rounded p-2">Статьи</a>
            <a href="{{ route('admin.books.index') }}" class="hover:bg-slate-700 rounded p-2">Книги</a>
            <a href="{{ route('admin.authors.index') }}" class="hover:bg-slate-700 rounded p-2">Авторы</a>
            <a href="{{ route('admin.taxonomy.index') }}" class="hover:bg-slate-700 rounded p-2">Категории и Теги</a>
        </nav>
    </aside>

    <main class="w-full p-6">
        {{ $slot }}
    </main>
</div>

@livewireScripts
</body>
</html>
