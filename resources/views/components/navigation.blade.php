@props(['inFooter' => false])

<nav x-data="{ isOpen: false }" class="relative">
    {{-- Десктопная навигация --}}
    <div class="hidden lg:flex items-center {{ $inFooter ? 'space-x-4' : 'space-x-6' }}">
        @foreach ($items as $item)
            <x-nav-item :item="$item" />
        @endforeach

        @if(!$inFooter)
            <div class="pl-6 flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-medium hover:text-sky-600 transition-colors">Вход</a>
                    <a href="{{ route('register') }}" class="text-sm font-medium px-4 py-2 bg-sky-500 text-white rounded-md hover:bg-sky-600 transition-colors">Регистрация</a>
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

    {{-- Мобильная навигация --}}
    <div class="lg:hidden">

        <button @click="isOpen = !isOpen" class="p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-sky-500 transition-colors">


            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        {{-- Мобильное выпадающее меню --}}
        <div x-show="isOpen"
             @click.away="isOpen = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="absolute top-full right-0 mt-2 w-64 bg-white rounded-lg shadow-xl border z-30"
             x-cloak>
            <div class="py-2">
                @foreach ($items as $item)
                    <x-nav-item :item="$item" :is-mobile="true" />
                @endforeach

                @if(!$inFooter)
                    <div class="border-t border-gray-200 mt-2 pt-2">
                        @guest
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Вход</a>
                            <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Регистрация</a>
                        @endguest
                        @auth
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Личный кабинет</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Выход</button>
                            </form>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>
