{{--<header class="bg-white border-b border-gray-100 sticky top-0 z-40">--}}
{{--    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">--}}
{{--        <div class="flex justify-between items-center h-16">--}}
{{--            --}}{{-- Левая часть: Логотип --}}
{{--            <div class="flex items-center space-x-4">--}}
{{--                <a href="{{ route('home') }}" class="flex items-center space-x-2 flex-shrink-0">--}}
{{--                    <img src="{{ asset('images/logo/logo.webp') }}" alt="Логотип" class="h-10 w-auto">--}}
{{--                </a>--}}

{{--                --}}{{-- Поисковая форма только на очень больших экранах --}}
{{--                <div class="hidden xl:block">--}}
{{--                    <form action="{{ route('search') }}" method="GET" class="relative">--}}
{{--                        <input--}}
{{--                            type="text"--}}
{{--                            name="q"--}}
{{--                            value="{{ request('q') }}"--}}
{{--                            placeholder="Поиск..."--}}
{{--                            class="w-80 pl-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-400 text-sm"--}}
{{--                        >--}}
{{--                        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-sky-600 transition-colors">--}}
{{--                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />--}}
{{--                            </svg>--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            --}}{{-- Правая часть: Навигация --}}
{{--            <div class="flex items-center">--}}
{{--                <x-header-navigation />--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        --}}{{-- Поисковая форма для планшетов и мобильных --}}
{{--        <div class="xl:hidden pb-4 border-t border-gray-100 pt-4">--}}
{{--            <x-search-form />--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</header>--}}


<header class="bg-white border-b border-gray-100 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            {{-- Левая часть: Логотип --}}
            <div class="flex items-center space-x-8">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 flex-shrink-0">
                    <img src="{{ asset('images/logo/logo.webp') }}" alt="Логотип" class="h-10 w-auto">
                </a>

                {{-- Поисковая форма только на очень больших экранах --}}
                <div class="hidden xl:block flex-1 min-w-0">
                    <form action="{{ route('search') }}" method="GET" class="relative max-w-md">
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Поиск..."
                            class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-400 text-sm"
                        >
                        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-sky-600 transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Правая часть: Навигация --}}
            <div class="flex items-center flex-shrink-0">
                <x-header-navigation />
            </div>
        </div>

        {{-- Поисковая форма для планшетов и мобильных --}}
        <div class="xl:hidden pb-4 border-t border-gray-100 pt-4">
            <x-search-form />
        </div>
    </div>
</header>
