<header class="bg-white shadow-md">
    <nav class="container mx-auto p-4 flex justify-between items-center">
        <a href="/" class="text-xl font-bold" wire:navigate>Dandaron Tradition</a>

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
