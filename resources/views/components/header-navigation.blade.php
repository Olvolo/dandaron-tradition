<nav x-data="{ isOpen: false }" class="relative">
    {{-- Десктопное меню --}}
    <div class="hidden lg:flex items-center space-x-6">
        @if($items->isNotEmpty())
            @foreach ($items as $item)
                <x-header-nav-item :item="$item" />
            @endforeach
        @endif

        {{-- Блок аутентификации --}}
        <div class="pl-6 border-l border-gray-200 flex items-center space-x-4">
            @guest
                <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-sky-600 transition-colors">
                    Вход
                </a>
                <a href="{{ route('register') }}" class="text-sm font-medium px-4 py-2 bg-sky-500 text-white rounded-md hover:bg-sky-600 transition-colors">
                    Регистрация
                </a>
            @endguest
            @auth
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 hover:text-sky-600 transition-colors">
                    Личный кабинет
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-gray-700 hover:text-sky-600 transition-colors">
                        Выход
                    </button>
                </form>
            @endauth
        </div>
    </div>

    {{-- Мобильное меню --}}
    <div class="lg:hidden">
        <button @click="isOpen = !isOpen" class="p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-sky-500 transition-colors">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div x-show="isOpen"
             @click.away="isOpen = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="absolute top-full right-0 mt-2 w-64 bg-white rounded-lg shadow-xl border z-30"
             x-cloak>
            <div class="py-2">
                @if($items->isNotEmpty())
                    @foreach ($items as $item)
                        <x-header-nav-item :item="$item" :is-mobile="true" />
                    @endforeach
                @endif

                <div class="border-t border-gray-200 mt-2 pt-2">
                    @guest
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                            Вход
                        </a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                            Регистрация
                        </a>
                    @endguest
                    @auth
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                            Личный кабинет
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                Выход
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
