@section('title', $article->title . ' | Dandaron Tradition')
@section('description', Str::limit(strip_tags($article->annotation ?: $article->content_html), 255))

<x-layout>
    <div class="bg-white/80 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-4">{{ $article->title }}</h1>

        @if($article->annotation)
            <p class="text-lg text-gray-700 italic mb-6 border-l-4 border-amber-400 pl-4">{{ $article->annotation }}</p>
        @endif

        <div class="prose prose-lg max-w-none">
            {!! $article->content_html !!}
        </div>
    </div>
</x-layout>
