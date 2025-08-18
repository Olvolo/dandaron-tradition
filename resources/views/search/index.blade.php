{{--<x-app-layout>--}}
{{--    <div class="max-w-4xl mx-auto mt-8">--}}
{{--        <h1 class="text-2xl text-sky-950 font-bold mx-4 mb-4">Результаты поиска по запросу: "{{--}}
{{--        $query--}}
{{--        }}"</h1>--}}

{{--        @if($results->isEmpty())--}}
{{--            <p>Ничего не найдено.</p>--}}
{{--        @else--}}
{{--            <div class="space-y-4">--}}
{{--                @foreach($results as $item)--}}
{{--                    <div class="bg-sky-100 p-6 border border-sky-300 rounded-lg">--}}
{{--                        --}}{{-- Заголовок --}}
{{--                        <h3 class="text-lg font-semibold mb-2">--}}
{{--                            <a href="{{ $item->url }}" class="text-blue-600 hover:underline">--}}
{{--                                {!! $item->title !!}--}}
{{--                            </a>--}}
{{--                        </h3>--}}

{{--                        --}}{{-- Тип контента --}}
{{--                        <div class="mb-3">--}}
{{--                            <span class="inline-block bg-sky-100 text-sky-800 px-2 py-1 rounded--}}
{{--                            text-sm">--}}
{{--                                {{ $item->type }}--}}
{{--                            </span>--}}
{{--                        </div>--}}

{{--                        --}}{{-- Фрагменты --}}
{{--                        @if(count($item->fragments) > 0)--}}
{{--                            @foreach($item->fragments as $fragment)--}}
{{--                                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-3">--}}
{{--                                    <div class="text-sky-900 leading-relaxed">--}}
{{--                                        {!! $fragment !!}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        @else--}}
{{--                            --}}{{-- Если фрагментов нет, показываем краткое описание --}}
{{--                            <div class="text-sky-700 mb-3">--}}
{{--                                {{ Str::limit($item->model->annotation ?? $item->model->description ?? 'Нет описания', 200) }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</x-app-layout>--}}

<x-layout :content="$content">
    @section('title', 'Поиск по сайту')

    <div class="max-w-4xl mx-auto mt-8 px-4">

        {{-- Форма Поиска и Фильтров --}}
        <form action="{{ route('search') }}" method="GET" class="bg-white p-6 rounded-lg shadow-md mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Поле для текстового поиска --}}
                <div class="md:col-span-3">
                    <label for="q" class="block text-sm font-medium text-gray-700">Поисковый запрос</label>
                    <input type="text" name="q" id="q" value="{{ old('q', $query) }}" placeholder="Введите слово или фразу..." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500">
                </div>

                {{-- Фильтр по Категориям --}}
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Категория</label>
                    <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500">
                        <option value="">-- Все категории --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if(request('category') == $category->id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Фильтр по Тегам --}}
                <div>
                    <label for="tag" class="block text-sm font-medium text-gray-700">Тег</label>
                    <select name="tag" id="tag" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500">
                        <option value="">-- Все теги --</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" @if(request('tag') == $tag->id) selected @endif>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Кнопка "Применить" --}}
                <div class="md:col-start-3 flex items-end">
                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        Применить
                    </button>
                </div>
            </div>
        </form>

        {{-- Результаты Поиска --}}
        <h1 class="text-2xl text-sky-950 font-bold mb-4">Результаты поиска</h1>

        @if($results->isEmpty())
            <p class="text-gray-600">Ничего не найдено по вашему запросу.</p>
        @else
            <p class="text-gray-600 mb-4">Найдено результатов: {{ $results->count() }}</p>

            {{-- ЭТОТ БЛОК БЫЛ ПРОПУЩЕН --}}
            <div class="space-y-6">
                @foreach($results as $item)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        {{-- Заголовок --}}
                        <h3 class="text-lg font-semibold mb-2">
                            <a href="{{ $item->url }}" class="text-blue-600 hover:underline">
                                {!! $item->title !!}
                            </a>
                        </h3>

                        {{-- Тип контента --}}
                        <div class="mb-3">
                            <span class="inline-block bg-sky-100 text-sky-800 px-2 py-1 rounded text-sm">
                                {{ $item->type }}
                            </span>
                        </div>

                        {{-- Фрагменты --}}
                        @if(!empty($item->fragments))
                            @foreach($item->fragments as $fragment)
                                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-3">
                                    <div class="text-sky-900 leading-relaxed">
                                        {!! $fragment !!}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            {{-- Если фрагментов нет, показываем аннотацию или описание --}}
                            <div class="text-sky-700 mb-3 italic">
                                {{ Str::limit(strip_tags($item->model->annotation ?? $item->model->description ?? 'Нет описания'), 250) }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            {{-- КОНЕЦ ПРОПУЩЕННОГО БЛОКА --}}

        @endif
    </div>
</x-layout>
