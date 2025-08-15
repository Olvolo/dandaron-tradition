@php use App\Models\Chapter; @endphp
<x-layout>
    @section('title', 'Результаты поиска')

    <div class="bg-white/80 p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-4">Результаты поиска</h1>

        @if($query)
            <p class="mb-6 text-lg">По запросу: <strong
                    class="font-semibold text-sky-800">{{ $query }}</strong></p>
        @endif

        @if($results->isEmpty())
            <p class="text-sky-700">К сожалению, по вашему запросу ничего не найдено.</p>
        @else
            <div class="space-y-6">
                @foreach($results as $result)
                    <div class="border-b border-sky-300 pb-4">
                        @php
                            $model = $result->model; // Для удобства
                            $url = '#';
                            if ($model instanceof Chapter) {
                                $url = route('chapters.show', ['chapter' => $model->slug]);
                            } elseif ($model->placement) {
                                $url = url($model->placement->full_slug);
                            }
                        @endphp

                        <a href="{{ $url }}" class="text-xl text-sky-700 hover:underline">
                            {{ $model->title ?? 'Без названия' }}
                        </a>

                        <p class="text-sm text-sky-600 mt-1">
                            Тип: {{ class_basename($model) }}
                        </p>

                        {{-- ИСПОЛЬЗУЕМ НОВУЮ СТРУКТУРУ ДАННЫХ --}}
                        @if(!empty($result->formatted))
                            <div class="mt-2 text-sky-800 text-sm space-y-1 bg-sky-100 p-2 rounded">
                                @foreach($result->formatted as $field => $snippet)
                                    <p>...{!! $snippet !!}...</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
