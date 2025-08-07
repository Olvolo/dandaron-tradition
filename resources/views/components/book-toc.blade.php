<div x-data="{ tocOpen: false }">
    {{-- Плавающая кнопка "Оглавление" --}}
    <button @click="tocOpen = true"
            class="fixed bottom-5 left-5 z-40 px-4 py-2 bg-sky-600 text-white rounded-full shadow-lg hover:bg-sky-700">
        Оглавление
    </button>

    {{-- Панель оглавления --}}
    <template x-teleport="body">
        <div x-show="tocOpen" x-cloak class="fixed inset-0 z-50 flex">
            <div @click="tocOpen = false" class="absolute inset-0 bg-black/50"></div>
            <div class="relative flex flex-col max-w-xs w-full h-full bg-white">
                <div class="flex-shrink-0 p-6 border-b">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold">Оглавление</h3>
                        <button @click="tocOpen = false" class="p-1 rounded-full hover:bg-gray-200">&times;</button>
                    </div>
                </div>
                <div class="flex-grow p-6 overflow-y-auto">
                    <ul class="space-y-2">
                        @foreach($book->chapters->whereNull('parent_id')->sortBy('order_column') as $chapter)
                            @include('pages.partials.toc-item', ['chapter' => $chapter])
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </template>
</div>
