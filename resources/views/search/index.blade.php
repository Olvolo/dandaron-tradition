<x-app-layout>
    <div class="max-w-4xl mx-auto mt-8">
        <h1 class="text-2xl text-sky-950 font-bold mx-4 mb-4">Результаты поиска по запросу: "{{
        $query
        }}"</h1>

        @if($results->isEmpty())
            <p>Ничего не найдено.</p>
        @else
            <div class="space-y-4">
                @foreach($results as $item)
                    <div class="bg-white p-6 border border-gray-200 rounded-lg">
                        {{-- Заголовок --}}
                        <h3 class="text-lg font-semibold mb-2">
                            <a href="{{ $item->url }}" class="text-blue-600 hover:underline">
                                {!! $item->title !!}
                            </a>
                        </h3>

                        {{-- Тип контента --}}
                        <div class="mb-3">
                            <span class="inline-block bg-gray-100 text-gray-700 px-2 py-1 rounded text-sm">
                                {{ $item->type }}
                            </span>
                        </div>

                        {{-- Фрагменты --}}
                        @if(count($item->fragments) > 0)
                            @foreach($item->fragments as $fragment)
                                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-3">
                                    <div class="text-gray-800 leading-relaxed">
                                        {!! $fragment !!}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            {{-- Если фрагментов нет, показываем краткое описание --}}
                            <div class="text-gray-600 mb-3">
                                {{ Str::limit($item->model->annotation ?? $item->model->description ?? 'Нет описания', 200) }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
