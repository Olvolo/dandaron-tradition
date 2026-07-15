<x-layout :content="$chapter">
    @push('schema')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "Chapter",
        "name": "{{ $chapter->title }}",
        "description": "{{ $chapter->getSeoDescription() }}",
        "position": {{ $chapter->order_column ?? 1 }},
        "url": "{{ $chapter->getUrl() }}",
        "isPartOf": {
            "@type": "Book",
            "name": "{{ $book->title }}",
            "url": "{{ $book->getUrl() }}"
        },
        "author": [
            @foreach($book->authors as $author)
            {
                "@type": "Person",
                "name": "{{ $author->name }}"
            }{{ !$loop->last ? ',' : '' }}
            @endforeach
        ]
    }
    </script>
    @endpush

    <div class="bg-white/80 p-2 rounded-lg shadow-lg">
        <h1 class="text-3xl text-center font-bold mb-4">{{ $chapter->title }}</h1>

        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="prose prose-lg max-w-none">
            {!! $chapter->content_html !!}
        </div>

        <x-book-toc :book="$book" />
    </div>
</x-layout>
