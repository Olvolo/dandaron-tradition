@extends('layouts.app')

@section('title', 'Результаты поиска')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Результаты поиска</h1>

    @if($query)
        <p class="mb-4">По запросу: <strong>{{ $query }}</strong></p>
    @endif

    @if($results->isEmpty())
        <p>Ничего не найдено.</p>
    @else
        <ul class="space-y-2">
            @foreach($results as $item)
                <li>
                    <a href="{{ url('/'.$item->slug) }}" class="text-blue-600 hover:underline">
                        {{ $item->title ?? $item->name ?? 'Без названия' }}
                    </a>
                    <small class="text-gray-500 block">
                        Тип: {{ class_basename($item) }}
                    </small>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
