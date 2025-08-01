<x-app-layout>
    <div class="max-w-4xl mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Результаты поиска по запросу: "{{ $query }}"</h1>

        @if($articles->isEmpty() && $books->isEmpty() && $chapters->isEmpty())
            <p>Ничего не найдено.</p>
        @endif

        @if($articles->isNotEmpty())
            <h2 class="text-xl font-semibold mt-6 mb-2">Статьи</h2>
            <ul>
                @foreach ($articles as $article)
                    <li class="mb-1">
                        <a href="{{ route('page.show', ['slug' => $article->placement->full_slug ?? '#']) }}"
                           class="text-blue-600 hover:underline">
                            {{ $article->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif

        @if($books->isNotEmpty())
            <h2 class="text-xl font-semibold mt-6 mb-2">Книги</h2>
            <ul>
                @foreach ($books as $book)
                    <li class="mb-1">
                        <a href="{{ route('page.show', ['slug' => $book->placement->full_slug ?? '#']) }}"
                           class="text-blue-600 hover:underline">
                            {{ $book->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif

        @if($chapters->isNotEmpty())
            <h2 class="text-xl font-semibold mt-6 mb-2">Главы</h2>
            <ul>
                @foreach ($chapters as $chapter)
                    <li class="mb-1">
                        <a href="{{ route('page.show', ['slug' => $chapter->placement->full_slug ?? '#']) }}"
                           class="text-blue-600 hover:underline">
                            {{ $chapter->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
