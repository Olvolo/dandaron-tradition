<nav x-data="{ isOpen: false }" class="relative">
    {{-- Десктопная версия (простой горизонтальный список) --}}
    <div class="hidden md:flex flex-wrap justify-center items-center space-x-6 leading-none">
        @if($items->isNotEmpty())
            @foreach ($items as $item)
                <x-footer-nav-item :item="$item" />
            @endforeach
        @endif
    </div>

    {{-- Мобильная версия (кнопка с выпадающим меню вверх) --}}
    <div class="md:hidden leading-none">

        <button
            @click="isOpen = !isOpen"
            aria-label="Меню навигации"
            :aria-expanded="isOpen"
            aria-controls="footer-mobile-menu"
            class="p-1 rounded-md text-sky-950 hover:bg-sky-200
                focus:outline-none focus:ring-2 focus:ring-sky-900 transition-colors"
        >
            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" aria-hidden="true">
                <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>


        {{-- Выпадающее меню (открывается вверх) --}}
        <div id="footer-mobile-menu"
            x-show="isOpen"
            @click.away="isOpen = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="absolute bottom-full mb-1 right-0 w-64 bg-sky-600 rounded-lg shadow-xl border border-sky-500 z-30"
            x-cloak>
            <div class="py-1">
                @if($items->isNotEmpty())
                    @foreach ($items as $item)
                        <x-footer-nav-item :item="$item" :is-mobile="true" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
