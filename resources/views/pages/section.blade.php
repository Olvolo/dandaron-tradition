<x-layout :content="$placement">
    {{-- Сначала выводим основной контент главной страницы (если он есть) --}}
    @if ($placement->placementable)
        <div class="bg-white/80 p-8 rounded-lg shadow-lg mb-8">
            <div class="prose prose-lg max-w-none">
                {!! $placement->placementable->content_html !!}
            </div>
        </div>
    @endif

    {{-- Теперь выводим карточки дочерних разделов --}}
    @if ($subSections->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($subSections as $section)
                <a href="{{ url($section->full_slug) }}" class="block bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300" >
                    <h2 class="text-xl text-center font-bold text-gray-800">{{ $section->title }}</h2>
                    {{-- В будущем здесь можно будет выводить аннотацию раздела --}}
                </a>
            @endforeach
        </div>
    @endif
</x-layout>
