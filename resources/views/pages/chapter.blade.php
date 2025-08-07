<x-layout :content="$chapter">  <!-- Передаём $chapter как content -->
    <div class="bg-white/80 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl text-center font-bold mb-4">{{ $chapter->title }}</h1>

        <div class="prose prose-lg max-w-none">
            {!! $chapter->content_html !!}
        </div>

        <x-book-toc :book="$book" />
    </div>
</x-layout>
