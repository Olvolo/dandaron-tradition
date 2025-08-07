<header class="bg-white shadow-md">
    <nav class="container mx-auto p-4 flex justify-between items-center">
        {{-- Логотип --}}
        <a href="{{ route('home') }}" class="flex items-center" wire:navigate>
            <img
                src="{{ asset('images/logo/logo.webp') }}"
                alt="Dandaron Tradition"
                class="h-10 w-auto"
            >
        </a>

        {{-- Основное меню --}}
        <div class="hidden md:flex items-center space-x-8">
            <a href="{{ route('home') }}"
               class="text-gray-900 hover:text-blue-600 transition">
                Главная
            </a>

            @foreach($menuItems as $item)
                <a href="{{ url($item->full_slug) }}"
                   class="text-gray-900 hover:text-blue-600 transition">
                    {{ $item->title }}
                </a>
            @endforeach
        </div>

        {{-- Поисковая форма --}}
        <div class="flex-1 max-w-md mx-4">
            <form action="{{ route('search') }}" method="GET" class="flex">
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Поиск по сайту..."
                    class="w-full px-3 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700 transition">
                    Найти
                </button>
            </form>
        </div>

        {{-- Аутентификация --}}
        <div class="text-sm">
            @auth
                <div class="flex items-center space-x-4">
                    <span>{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="hover:text-amber-600 transition">
                            Выйти
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="hover:text-amber-600 transition">Войти</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 hover:text-amber-600 transition">Регистрация</a>
                @endif
            @endauth
        </div>
    </nav>
</header>
