<header class="bg-sky-200 border-b border-sky-300 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center h-16">

            {{-- Левая мобильная кнопка: дерево разделов --}}
            <button
                @click.stop="mobileLeftSidebar = true"
                class="xl:hidden mr-3 p-2 rounded-md text-sky-900 hover:bg-sky-300 focus:outline-none"
                aria-label="Меню"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            {{-- ЛОГОТИП + ПОИСК --}}
            <div class="flex items-center space-x-8">

                {{-- ЛОГО --}}
                <a href="{{ route('home') }}" class="flex items-center space-x-2 flex-shrink-0">
                    <img src="{{ asset('images/logo/logo.webp') }}" alt="Логотип" class="h-10 w-auto">
                </a>

                {{-- ПОИСК ДЛЯ ДЕСКТОПА --}}
                <div class="hidden xl:block flex-1 min-w-0">
                    <form action="{{ route('search') }}" method="GET" class="relative max-w-md">
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Поиск..."
                            class="w-full pl-4 pr-10 py-2 border border-sky-300 rounded-lg
                                   focus:outline-none focus:ring-2 focus:ring-sky-400 text-sm text-sky-800"
                        >
                        <button type="submit"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-sky-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

            </div>

            {{-- ПРАВАЯ ЧАСТЬ: десктопная навигация + мобильная кнопка "врата" --}}
            <div class="flex items-center flex-shrink-0">

                {{-- ДЕСКТОПНОЕ МЕНЮ --}}
                <x-header-navigation />

                {{-- МОБИЛЬНАЯ ПРАВАЯ КНОПКА --}}
                <button
                    @click.stop="mobileRightSidebar = true"
                    class="xl:hidden ml-3 p-2 rounded-md text-sky-900 hover:bg-sky-300 focus:outline-none"
                    aria-label="Врата"
                >
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 3h12M6 21h12M3 6h18M3 18h18M9 9h6v6H9z" />
                    </svg>
                </button>

            </div>

        </div>

        {{-- ПОИСК ДЛЯ МОБИЛЬНЫХ --}}
        <div class="xl:hidden pb-1 border-t border-sky-300">
            <x-search-form />
        </div>

    </div>
</header>
