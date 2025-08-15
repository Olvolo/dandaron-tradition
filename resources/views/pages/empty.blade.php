<x-layout>
    @section('title', $placement->title)

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">

            {{-- Хлебные крошки --}}
            @if($placement->parent)
                <nav class="mb-6">
                    <ol class="flex items-center space-x-2 text-sm text-sky-700">
                        <li><a href="{{ url('/') }}" class="hover:text-blue-600">Главная</a></li>

                        @php
                            $ancestors = $placement->getAncestors()->reverse();
                        @endphp

                        @foreach($ancestors as $ancestor)
                            @if($ancestor->slug !== 'home')
                                <li class="before:content-['/'] before:mx-2 before:text-sky-500">
                                    <a href="{{ url($ancestor->full_slug) }}" class="hover:text-blue-600">
                                        {{ $ancestor->title }}
                                    </a>
                                </li>
                            @endif {{-- <-- Закрываем внутренний @if --}}
                        @endforeach

                        <li class="before:content-['/'] before:mx-2 before:text-sky-500">
                            <span class="text-sky-950 font-medium">{{ $placement->title }}</span>
                        </li>
                    </ol>
                </nav>
            @endif {{-- <-- Закрываем внешний @if --}}

            {{-- Заголовок страницы --}}
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-sky-950 mb-4">
                    {{ $placement->title }}
                </h1>
            </div>

            {{-- Основной контент --}}
            <div class="prose prose-lg max-w-none">

                @if($placement->slug === 'kontakty')
                    {{-- Специальный контент для страницы контактов --}}
                    <div class="bg-sky-100 p-6 rounded-lg mb-8">
                        {{-- ... код для контактов ... --}}
                    </div>
                @else
                    {{-- Общий контент для других пустых страниц --}}
                    <div class="bg-yellow-50 border border-yellow-200 p-6 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Страница в разработке</h3>
                                <p class="mt-1 text-sm text-yellow-700">
                                    Контент для этой страницы еще не добавлен. Пожалуйста, зайдите позже.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-layout>
