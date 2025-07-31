<x-layout>
    <div class="bg-white/80 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-2">{{ $book->title }}</h1>
        <p class="text-md text-gray-600 mb-4">Авторы: {{ $book->authors->pluck('name')->join(', ') }}</p>

        @if($book->annotation)
            <p class="text-lg text-gray-700 italic mb-6 border-l-4 border-amber-400 pl-4">{{ $book->annotation }}</p>
        @endif

        <div class="prose prose-lg max-w-none">
            {!! $book->description !!}
        </div>

        <h2 class="text-2xl font-bold mt-8 mb-4">Оглавление</h2>
        <ul class="prose prose-lg">
            @foreach($book->chapters as $chapter)
                {{-- Мы явно указываем, что для параметра 'chapter' нужно использовать slug --}}
                <li><a href="{{ route('chapters.show', ['chapter' => $chapter->slug]) }}">{{ $chapter->title }}</a></li>
            @endforeach
        </ul>
    </div>
</x-layout>
