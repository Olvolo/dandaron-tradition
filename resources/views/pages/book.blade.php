<x-layout :content="$book">
    @section('title', $book->title)

{{--    <div class="bg-white/80 p-6 md:p-8 rounded-lg shadow-lg">--}}
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
            <div class="relative flex flex-col max-w-xs w-full h-full bg-white">
                <div class="flex-shrink-0 p-6 border-b">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold">Оглавление</h3>
                        <button @click="tocOpen = false" class="p-1 rounded-full hover:bg-sky-300 text-2xl leading-none">&times;</button>
                    </div>
                </div>
                <div class="flex-grow p-6 overflow-y-auto">
                    <ul class="space-y-2">
                        @foreach($book->chapters->whereNull('parent_id')->sortBy('order_column') as $chapter)
{{--                            @include('pages.partials.toc-item', ['chapter' => $chapter])--}}
                            @include('pages.partials.toc-item', ['chapter' => $chapter, 'level' => 0])
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </template>

</x-layout>
