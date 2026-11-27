<x-layout :content="$chapter">

    @push('schema')
        @php
            $chapterSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'Chapter',
                'name' => $chapter->title,
                'description' => $chapter->getSeoDescription(),
                'position' => $chapter->order_column ?? 1,
                'url' => $chapter->getUrl(),
                'isPartOf' => [
                    '@type' => 'Book',
                    'name' => $book->title,
                    'url' => $book->getUrl(),
                ],
                'author' => $book->authors->map(fn ($author) => [
                    '@type' => 'Person',
                    'name' => $author->name,
                ])->values()->all(),
            ];
        @endphp

        <script type="application/ld+json">
            @json($chapterSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        </script>
    @endpush


    <div class="bg-white/80 p-2 rounded-lg shadow-lg">
        <h1 class="text-3xl text-center font-bold mb-4">{{ $chapter->title }}</h1>

        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="prose prose-lg max-w-none">
            {!! $chapter->getContentWithAbsoluteAnchors() !!}
        </div>

        <x-book-toc :book="$book" />
    </div>
</x-layout>
