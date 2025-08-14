
@props(['inFooter' => false])

<nav x-data="{ isOpen: false }" class="relative">

    <div class="hidden lg:flex items-center {{ $inFooter ? 'space-x-4' : 'space-x-6' }}">
        @foreach ($items as $item)
            <x-nav-item :item="$item" :in-footer="$inFooter" />
        @endforeach


        @if(!$inFooter)
            <div class="pl-6 flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-sm  text-main-page font-normal
                    hover:text-sky-600
                     transition-colors">Вход</a>
                    <a href="{{ route('register') }}" class="text-sm font-medium px-4 py-2
                    bg-sky-500 text-sky-100 rounded-md hover:bg-sky-600
                    transition-colors">Регистрация</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium hover:text-sky-600 transition-colors">Личный кабинет</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium hover:text-sky-600 transition-colors">Выход</button>
                    </form>
                @endauth
            </div>
        @endif
    </div>

    <div class="{{ $inFooter ? 'lg:block' : 'lg:hidden' }}">

        <button @click="isOpen = !isOpen" class="p-2 rounded-md {{ $inFooter ? 'text-sky-100
        hover:text-sky-200 hover:bg-sky-700' : 'text-sky-900 hover:text-sky-950 hover:bg-sky-100'
        }} focus:outline-none focus:ring-2 focus:ring-sky-500 transition-colors">

            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div x-show="isOpen"
             @click.away="isOpen = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform {{ $inFooter ? 'translate-y-2' : '-translate-y-2' }}"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform {{ $inFooter ? 'translate-y-2' : '-translate-y-2' }}"
             class="absolute {{ $inFooter ? 'bottom-full mb-2' : 'top-full mt-2' }} right-0 w-64 bg-sky-100 rounded-lg shadow-xl border z-30"
             x-cloak>
            <div class="py-2">
                @foreach ($items as $item)
                    <x-nav-item :item="$item" :is-mobile="true" :in-footer="$inFooter" />
                @endforeach

                @if(!$inFooter)
                    <div class="border-t border-sky-200 mt-2 pt-2">
                        @guest
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm
                            text-sky-900
                            hover:bg-sky-100 transition-colors">Вход</a>
                            <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-sky-900  hover:bg-sky-100 transition-colors">Регистрация</a>
                        @endguest
                        @auth
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-sky-900  hover:bg-sky-100 transition-colors">Личный кабинет</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-sky-900  hover:bg-sky-100 transition-colors">Выход</button>
                            </form>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>


{{--@php use App\Models\Placement; @endphp--}}

{{--@props(['inFooter' => false])--}}

{{--@php--}}
{{--    $homePlacement = Placement::whereNull('parent_id')->first();--}}
{{--    $menuItems = $homePlacement--}}
{{--        ? $homePlacement->children()->where('show_in_menu', true)->with('children')->orderBy('order_column')->get()--}}
{{--        : collect();--}}
{{--@endphp--}}

{{--@if ($inFooter)--}}
{{--    --}}{{-- ВЕРСИЯ ДЛЯ ПОДВАЛА (FOOTER) --}}
{{--    <nav class="flex flex-wrap justify-center gap-x-4 gap-y-2">--}}
{{--        @foreach ($menuItems as $item)--}}
{{--            <a href="{{ url($item->full_slug) }}"--}}
{{--               class="text-sm text-sky-100 hover:text-white transition-colors">--}}
{{--                {{ $item->title }}--}}
{{--            </a>--}}
{{--        @endforeach--}}
{{--    </nav>--}}
{{--@else--}}
{{--    --}}{{-- ВЕРСИЯ ДЛЯ ШАПКИ (HEADER) --}}
{{--    <nav x-data="{ isOpen: false }" class="relative">--}}
{{--        <!-- Десктопное меню -->--}}
{{--        <div class="hidden md:flex items-center space-x-6">--}}
{{--            @foreach ($menuItems as $item)--}}
{{--                <x-nav-item :item="$item" />--}}
{{--            @endforeach--}}

{{--            --}}{{-- Блок входа/регистрации --}}
{{--            <div class="pl-4 flex items-center space-x-4">--}}
{{--                @guest--}}
{{--                    <a href="{{ route('login') }}" class="text-sm text-gray-800 hover:text-sky-600 transition-colors">--}}
{{--                        Вход--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('register') }}"--}}
{{--                       class="text-sm px-4 py-2 bg-sky-500 text-white rounded-md hover:bg-sky-600 transition-colors">--}}
{{--                        Регистрация--}}
{{--                    </a>--}}
{{--                @endguest--}}
{{--                @auth--}}
{{--                    <a href="{{ route('dashboard') }}" class="text-sm hover:text-sky-600 transition-colors">--}}
{{--                        Личный кабинет--}}
{{--                    </a>--}}
{{--                    <form method="POST" action="{{ route('logout') }}" class="inline">--}}
{{--                        @csrf--}}
{{--                        <button type="submit" class="text-sm hover:text-sky-600 transition-colors">--}}
{{--                            Выход--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                @endauth--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Мобильное меню -->--}}
{{--        <div class="md:hidden">--}}
{{--            <button @click="isOpen = !isOpen" class="p-2 focus:outline-none">--}}
{{--                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                    <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                          d="M4 6h16M4 12h16M4 18h16" />--}}
{{--                    <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                          d="M6 18L18 6M6 6l12 12" />--}}
{{--                </svg>--}}
{{--            </button>--}}

{{--            <!-- Выпадающее меню -->--}}
{{--            <div x-show="isOpen" @click.away="isOpen = false"--}}
{{--                 x-transition:enter="transition ease-out duration-200"--}}
{{--                 x-transition:enter-start="opacity-0 -translate-y-2"--}}
{{--                 x-transition:enter-end="opacity-100 translate-y-0"--}}
{{--                 x-transition:leave="transition ease-in duration-150"--}}
{{--                 class="absolute top-full right-0 mt-2 w-64 bg-white rounded-lg shadow-xl z-20"--}}
{{--                 x-cloak>--}}
{{--                <div class="py-2">--}}
{{--                    @foreach ($menuItems as $item)--}}
{{--                        <x-nav-item :item="$item" :is-mobile="true" />--}}
{{--                    @endforeach--}}
{{--                    <div class="border-t border-gray-200 mt-2 pt-2">--}}
{{--                        @guest--}}
{{--                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm hover:bg-sky-100">--}}
{{--                                Вход--}}
{{--                            </a>--}}
{{--                            <a href="{{ route('register') }}" class="block px-4 py-2 text-sm hover:bg-sky-100">--}}
{{--                                Регистрация--}}
{{--                            </a>--}}
{{--                        @endguest--}}
{{--                        @auth--}}
{{--                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm hover:bg-sky-100">--}}
{{--                                Личный кабинет--}}
{{--                            </a>--}}
{{--                            <form method="POST" action="{{ route('logout') }}">--}}
{{--                                @csrf--}}
{{--                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm hover:bg-sky-100">--}}
{{--                                    Выход--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                        @endauth--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </nav>--}}
{{--@endif--}}
