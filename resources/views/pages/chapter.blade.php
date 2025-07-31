<x-layout>
    <div class="bg-white/80 p-8 rounded-lg shadow-lg">
        {{-- TODO: Добавить "хлебные крошки" для навигации назад к книге --}}
        <h1 class="text-3xl font-bold mb-4">{{ $chapter->title }}</h1>

        <div class="prose prose-lg max-w-none">
            {!! $chapter->content_html !!}
        </div>
    </div>
</x-layout>
