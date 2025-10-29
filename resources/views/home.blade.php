{{--<x-layout :content="$content">--}}

{{--    <div class="container mx-auto md:py-8">--}}

{{--        @if($featured->isNotEmpty())--}}

{{--            <h2 class="text-3xl text-center text-main-page font-bold mt-4 mb-8 md:mt-8 md:mb-12 italic">--}}
{{--                Духовным подвижникам посвящается</h2>--}}

{{--            <div class="block md:flex md:justify-center">--}}

{{--                <div class="space-y-4 md:space-y-0 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-8">--}}
{{--                    @foreach($featured as $item)--}}
{{--                        <div class="w-full md:w-72">--}}
{{--                            <x-content-card :item="$item"/>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--    @endif--}}
{{--</x-layout>--}}
<x-layout :content="$content">
    <div class="container mx-auto pt-2 pb-4 md:py-8 px-4">
        @if($featured->isNotEmpty())
            <h2 class="text-2xl md:text-3xl text-center text-main-page font-bold mb-4 md:mt-8 md:mb-12 italic">
                Духовным подвижникам посвящается
            </h2>

            {{-- Список для мобильных --}}
            <div class="md:hidden space-y-3">
                @foreach($featured as $item)
                    @php
                        $displayItem = $item->placementable ?? $item;
                        $url = url($item->full_slug ?? '#');
                        $type = match($item->placementable_type) {
                            'App\\Models\\Article' => 'Статья',
                            'App\\Models\\Book' => 'Книга',
                            default => 'Раздел',
                        };
                    @endphp
                    <a href="{{ $url }}" class="flex items-center space-x-3 p-4 bg-sky-100/60 backdrop-blur-sm border border-sky-100/40 rounded-xl hover:bg-sky-100/80 transition-all duration-300">
                        <div class="flex-shrink-0">
                            @if($item->placementable_type === 'App\Models\Article')
                                <svg class="w-6 h-6 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                            @elseif($item->placementable_type === 'App\Models\Book')
                                <svg class="w-6 h-6 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25" /></svg>
                            @else
                                <svg class="w-6 h-6 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" /></svg>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-sky-950">{{ $displayItem->title }}</h3>
                            <p class="text-sm text-sky-900 mt-1">{{ $type }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Карточки для десктопа --}}
            <div class="hidden md:flex justify-center">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featured as $item)
                        <div class="w-72">
                            <x-content-card :item="$item"/>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layout>
