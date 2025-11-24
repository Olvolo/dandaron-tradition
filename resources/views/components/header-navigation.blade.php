<nav x-data="{ isOpen: false }" class="relative">
    {{-- Десктопное меню --}}
    <div class="hidden xl:flex items-center space-x-6">
        @if($items->isNotEmpty())
            @foreach ($items as $item)
                <x-header-nav-item :item="$item" />
            @endforeach
        @endif

        {{-- Блок аутентификации --}}
        <div class="pl-4 border-l border-sky-300 flex items-center space-x-2">
            @guest
                <a href="{{ route('login') }}" class="text-sm text-sky-800 hover:text-sky-600 transition-colors">
                    Вход
                </a>
                <a href="{{ route('register') }}" class="text-sm font-medium px-4 py-2 bg-sky-500
                 text-sky-50 rounded-md hover:bg-sky-600 transition-colors">
                    Регистрация
                </a>
            @endguest
            @auth
                <a href="{{ route('dashboard') }}" class="text-sm text-sky-800 hover:text-sky-600 transition-colors">
                    Личный кабинет
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-sky-800 hover:text-sky-600 transition-colors">
                        Выход
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
