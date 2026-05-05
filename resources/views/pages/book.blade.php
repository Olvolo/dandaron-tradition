<x-layout :content="$book">
    @section('title', $book->title)



    <div class="bg-white/80 p-4 md:p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        {{-- "Обложка" книги --}}
        <h1 class="text-4xl text-center font-bold mb-2">{{ $book->title }}</h1>
        <p class="text-lg text-sky-800 mb-4">Авторы: {{ $book->authors->pluck('name')->join(', ') }}</p>

        @if($book->annotation)
            <p class="text-xl text-sky-900 italic mb-6 border-l-4 border-amber-400 pl-4">{{ $book->annotation }}</p>
        @endif

        @if($book->description)
            <div class="prose prose-lg max-w-none mb-12">
                {!! $book->description !!}
            </div>
        @endif

        <hr>

        {{-- ЗАПУСКАЕМ ВЫВОД ВСЕХ ГЛАВ --}}
        @foreach($book->chapters->whereNull('parent_id')->sortBy('order_column') as $chapter)
            @include('pages.partials.chapter-content', ['chapter' => $chapter, 'level' => 0])
        @endforeach
    </div>

    {{-- Плавающая кнопка "Оглавление" (телепортируем в body) --}}
    <template x-teleport="body">
        <button @click="tocOpen = true" class="fixed bottom-5 left-5 z-40 px-4 py-2 bg-sky-600 text-white rounded-full shadow-lg hover:bg-sky-700">
            Оглавление
        </button>
    </template>

    {{-- Панель оглавления (телепортируем в body) --}}
    <template x-teleport="body">
        <div x-show="tocOpen" x-cloak class="fixed inset-0 z-50 flex">
            <div @click="tocOpen = false" class="absolute inset-0 bg-black/50"></div>
            <div class="relative flex flex-col max-w-md w-full h-full bg-white">
                <div class="flex-shrink-0 p-6 border-b">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold">Оглавление</h3>
                        <button @click="tocOpen = false" class="p-1 rounded-full hover:bg-sky-300 text-2xl leading-none">&times;</button>
                    </div>
                </div>
                <div class="flex-grow p-6 overflow-y-auto">
                    {{-- Панель управления оглавлением (только для админа) --}}
                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="fixed top-20 right-5 z-40 bg-white/90 p-3 rounded-lg shadow-lg text-sm">
                                <div class="font-semibold mb-2">Управление оглавлением:</div>
                                {{-- <button onclick="expandAll()" class="block w-full text-left px-2 py-1 hover:bg-sky-100 rounded">
                                    Развернуть всё
                                </button>
                                <button onclick="collapseAll()" class="block w-full text-left px-2 py-1 hover:bg-sky-100 rounded">
                                    Свернуть всё
                                </button> --}}
                                <button @click="window.dispatchEvent(new CustomEvent('toc-control', {detail: {open: true}}))" 
        class="block w-full text-left px-2 py-1 hover:bg-sky-100 rounded">
    Развернуть всё
</button>
<button @click="window.dispatchEvent(new CustomEvent('toc-control', {detail: {open: false}}))" 
        class="block w-full text-left px-2 py-1 hover:bg-sky-100 rounded">
    Свернуть всё
</button>
                            </div>
                        @endif
                    @endauth
                    <ul class="space-y-2">
                        @foreach($book->chapters->whereNull('parent_id')->sortBy('order_column') as $chapter)
                            @include('pages.partials.toc-item', ['chapter' => $chapter, 'level' => 0])
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </template>

    {{-- Скрипты для управления оглавлением --}}
    <script>
        function expandAll() {
            Object.keys(localStorage).forEach(key => {
                if (key.startsWith('_x_toc-')) {
                    localStorage.setItem(key, 'true');
                }
            });
            location.reload();
        }

        function collapseAll() {
            Object.keys(localStorage).forEach(key => {
                if (key.startsWith('_x_toc-')) {
                    localStorage.setItem(key, 'false');
                }
            });
            location.reload();
        }
    </script>

</x-layout>
