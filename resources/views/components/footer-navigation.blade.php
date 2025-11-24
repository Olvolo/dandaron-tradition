<nav x-data="{ isOpen: false }" class="relative">
    {{-- Десктопная версия (простой горизонтальный список) --}}
    <div class="hidden md:flex flex-wrap justify-center items-center space-x-6">
        @if($items->isNotEmpty())
            @foreach ($items as $item)
                <x-footer-nav-item :item="$item" />
            @endforeach
        @endif
    </div>

    {{-- Мобильная версия (кнопка с выпадающим меню вверх) --}}
    <div class="md:hidden">
        <button @click="isOpen = !isOpen" class="p-2 rounded-md text-sky-100 hover:text-sky-200 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-300 transition-colors">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        {{-- Выпадающее меню (открывается вверх) --}}
        <div x-show="isOpen"
             @click.away="isOpen = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-2"
             class="absolute bottom-full mb-2 right-0 w-64 bg-sky-600 rounded-lg shadow-xl border border-sky-500 z-30"
             x-cloak>
            <div class="py-2">
                @if($items->isNotEmpty())
                    @foreach ($items as $item)
                        <x-footer-nav-item :item="$item" :is-mobile="true" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
