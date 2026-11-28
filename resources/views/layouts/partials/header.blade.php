<header class="fixed top-0 left-0 right-0 bg-sky-400 border-b border-sky-300 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-12">

            {{-- Левая часть: логотип + мобильное меню --}}
            <div class="flex items-center">
                <button
                    @click.stop="mobileLeftSidebar = true"
                    class="mr-2 p-1.5 rounded-md text-sky-900 hover:bg-sky-300 focus:outline-none xl:hidden"
                    aria-label="Карта сайта">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <img
                        src="{{ asset('images/logo/logo.webp') }}"
                        alt="Логотип Dandaron Tradition"
                        width="64"
                        height="64"
                        class="h-8 w-8"
                    >
                </a>
            </div>

            {{-- Центр: поиск --}}
            <div class="flex-1 max-w-2xl mx-2 xl:mx-4">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Поиск..."
                        aria-label="Поиск по сайту"
                        class="w-full pl-4 pr-12 py-2 text-sm rounded-lg border border-sky-300
                            bg-white/90 focus:outline-none focus:ring-2 focus:ring-sky-500 text-sky-950"
                    >
                    <button
                        type="submit"
                        aria-label="Найти"
                        class="absolute right-1 top-1/2 -translate-y-1/2
                            w-9 h-9 flex items-center justify-center
                            rounded-md text-sky-900 hover:bg-sky-100 transition-colors"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            {{-- Правая часть: аутентификация (десктоп) + мобильная кнопка --}}
            <div class="flex items-center space-x-2">

                {{-- Десктопная аутентификация --}}
                <div class="hidden xl:flex items-center space-x-3">
                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-medium text-sky-950 hover:text-sky-700 transition-colors">
                            Вход
                        </a>
                        <a href="{{ route('register') }}" class="text-sm font-medium px-3 py-1.5 bg-sky-900 text-white rounded-md hover:bg-sky-950 transition-colors">
                            Регистрация
                        </a>
                    @endguest
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm text-sky-950 hover:text-sky-600 transition-colors">
                            Личный кабинет
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-sky-950 hover:text-sky-600 transition-colors">
                                Выход
                            </button>
                        </form>
                    @endauth
                </div>

                {{-- Мобильная кнопка "Врата" — только на мобильных --}}
                <button
                    @click.stop="mobileRightSidebar = true"
                    class="p-1.5 rounded-md text-sky-900 hover:bg-sky-300 focus:outline-none xl:hidden"
                    aria-label="Врата">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 3h12M6 21h12M3 6h18M3 18h18M9 9h6v6H9z" />
                    </svg>
                </button>

            </div>

        </div>
    </div>
</header>
