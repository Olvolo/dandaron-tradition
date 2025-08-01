<header class="bg-white shadow-md">
    <nav class="container mx-auto p-4 flex justify-between items-center">
        <a href="/" class="text-xl font-bold" wire:navigate>Dandaron Tradition</a>
        <form action="{{ route('search') }}" method="GET" class="flex items-center space-x-2 w-1/3">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Поиск по архиву..."
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-400"
            >
            <button type="submit"
                    class="bg-sky-600 text-white px-4 py-2 rounded hover:bg-sky-700 transition">
                Найти
            </button>
        </form>

        {{-- Проверяем, есть ли пункты меню для отображения --}}
        @if(isset($menuItems) && $menuItems->isNotEmpty())
            <ul class="flex space-x-6">
                {{-- Запускаем рекурсивный вывод меню --}}
                @foreach ($menuItems as $item)
                    @include('layouts.partials.nav-item', ['item' => $item])
                @endforeach
            </ul>
        @endif
    </nav>
</header>
