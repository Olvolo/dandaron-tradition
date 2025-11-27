{{--<x-layout :content="$placement">--}}
{{--    @section('title', $placement->title)--}}

{{--    --}}{{-- 1. Заголовок раздела --}}
{{--    <div class="prose prose-lg max-w-none mb-12">--}}
{{--        <h1 class="text-center">{{ $placement->title }}</h1>--}}
{{--    </div>--}}

{{--    @if($subSections->isNotEmpty())--}}
{{--        --}}{{----}}
{{--          2. Главный Alpine.js-компонент.--}}
{{--             Он читает 'viewMode' из localStorage. Если там пусто, по умолчанию ставит 'grid' (карточки).--}}
{{--        --}}
{{--        <div x-data="{ view: localStorage.getItem('viewMode') || 'grid' }">--}}

{{--            --}}{{-- 3. Кнопки-переключатели вида --}}
{{--            <div class="max-w-4xl mx-auto flex justify-end mb-4 px-4 sm:px-0">--}}
{{--                <div class="inline-flex rounded-md shadow-sm">--}}
{{--                    --}}{{-- Кнопка "Карточки" --}}
{{--                    <button--}}
{{--                        @click="view = 'grid'; localStorage.setItem('viewMode', 'grid')"--}}
{{--                        :class="{ 'bg-sky-700 text-white': view === 'grid', 'bg-sky-50 text-sky-600 hover:bg-sky-50': view !== 'grid' }"--}}
{{--                        class="px-3 py-2 rounded-l-md border border-sky-600 transition-colors duration-150"--}}
{{--                        title="Вид: Карточки">--}}
{{--                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 8.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25v2.25A2.25 2.25 0 018.25 20.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6A2.25 2.25 0 0115.75 3.75h2.25A2.25 2.25 0 0120.25 6v2.25a2.25 2.25 0 01-2.25 2.25h-2.25A2.25 2.25 0 0113.5 8.25V6zM13.5 15.75A2.25 2.25 0 0115.75 13.5h2.25a2.25 2.25 0 012.25 2.25v2.25a2.25 2.25 0 01-2.25 2.25h-2.25a2.25 2.25 0 01-2.25-2.25v-2.25z" />--}}
{{--                        </svg>--}}
{{--                    </button>--}}
{{--                    --}}{{-- Кнопка "Список" --}}
{{--                    <button--}}
{{--                        @click="view = 'list'; localStorage.setItem('viewMode', 'list')"--}}
{{--                        :class="{ 'bg-sky-700 text-white': view === 'list', 'bg-sky-50 text-sky-600 hover:bg-sky-50': view !== 'list' }"--}}
{{--                        class="px-3 py-2 rounded-r-md border-t border-r border-b border-sky-600 transition-colors duration-150"--}}
{{--                        title="Вид: Список">--}}
{{--                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />--}}
{{--                        </svg>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            --}}{{-- 4. Вид "Карточки" (Ваш существующий код) --}}
{{--            --}}{{-- Он будет показан, только если view === 'grid' --}}
{{--            <div x-show="view === 'grid'" class="centered-grid">--}}
{{--                @foreach($subSections as $subSection)--}}
{{--                    <div class="w-72">--}}
{{--                        <x-content-card :item="$subSection" />--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--            --}}{{-- 5. Вид "Список" (Новый код) --}}
{{--            --}}{{-- Он будет показан, только если view === 'list'.--}}
{{--                 x-cloak предотвращает "моргание" при загрузке. --}}
{{--            <div x-show="view === 'list'" class="max-w-4xl mx-auto space-y-3 px-4 sm:px-0" x-cloak>--}}
{{--                @foreach($subSections as $subSection)--}}
{{--                    <a href="{{ url($subSection->full_slug ?? '#') }}" class="flex items-center--}}
{{--                    space-x-4 p-4 bg-sky-50 shadow rounded-lg hover:bg-sky-100 transition-colors--}}
{{--                    duration-200">--}}
{{--                        --}}{{-- Иконка типа контента --}}
{{--                        <div>--}}
{{--                            @if($subSection->placementable_type === 'App\Models\Article')--}}
{{--                                <svg class="w-6 h-6 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>--}}
{{--                            @elseif($subSection->placementable_type === 'App\Models\Book')--}}
{{--                                <svg class="w-6 h-6 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25" /></svg>--}}
{{--                            @else--}}
{{--                                <svg class="w-6 h-6 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" /></svg>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <h3 class="text-lg font-semibold text-sky-800 hover:text-sky-900">{{ $subSection->title }}</h3>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @else--}}
{{--        --}}{{-- Этот блок будет показан, если в разделе нет дочерних страниц --}}
{{--        <p class="text-center text-gray-500">В этом разделе пока нет материалов.</p>--}}
{{--    @endif--}}
{{--</x-layout>--}}




<x-layout :content="$placement">
    @section('title', $placement->title)

    {{-- Заголовок всегда отображается --}}
    <div class="prose prose-lg max-w-none mb-12 text-center">
        <h1>{{ $placement->title }}</h1>
    </div>

    @if($subSections->isNotEmpty())
        {{-- ЕДИНЫЙ Alpine.js-контекст для кнопок И контента --}}
        <div x-data="{ view: localStorage.getItem('viewMode') || 'grid' }">

            {{-- Кнопки переключения — В СТРОКЕ ВЫШЕ, СЛЕВА --}}
            <div class="mb-6 px-4 sm:px-0">
                <div class="flex justify-center">
                    <div class="inline-flex rounded-md shadow-sm">
                        <button
                            @click="view = 'grid'; localStorage.setItem('viewMode', 'grid')"
                            :class="{ 'bg-sky-700 text-white': view === 'grid', 'bg-sky-50 text-sky-600 hover:bg-sky-50': view !== 'grid' }"
                            class="px-3 py-2 rounded-l-md border border-sky-600 transition-colors duration-150"
                            title="Вид: Карточки">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 8.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25v2.25A2.25 2.25 0 018.25 20.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6A2.25 2.25 0 0115.75 3.75h2.25A2.25 2.25 0 0120.25 6v2.25a2.25 2.25 0 01-2.25 2.25h-2.25A2.25 2.25 0 0113.5 8.25V6zM13.5 15.75A2.25 2.25 0 0115.75 13.5h2.25a2.25 2.25 0 012.25 2.25v2.25a2.25 2.25 0 01-2.25 2.25h-2.25a2.25 2.25 0 01-2.25-2.25v-2.25z" />
                            </svg>
                        </button>
                        <button
                            @click="view = 'list'; localStorage.setItem('viewMode', 'list')"
                            :class="{ 'bg-sky-700 text-white': view === 'list', 'bg-sky-50 text-sky-600 hover:bg-sky-50': view !== 'list' }"
                            class="px-3 py-2 rounded-r-md border-t border-r border-b border-sky-600 transition-colors duration-150"
                            title="Вид: Список">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Вид: Карточки --}}
            <div x-show="view === 'grid'" class="centered-grid px-4 sm:px-0">
                @foreach($subSections as $subSection)
                    <div class="w-72">
                        <x-content-card :item="$subSection" />
                    </div>
                @endforeach
            </div>

            {{-- Вид: Список --}}
            <div x-show="view === 'list'" class="max-w-4xl mx-auto space-y-2 px-4 sm:px-0" x-cloak>
                @foreach($subSections as $subSection)
                    <a href="{{ url($subSection->full_slug ?? '#') }}" class="flex items-center
                    space-x-3 p-4 bg-sky-50 shadow-sm rounded-lg hover:bg-sky-100 transition-colors duration-200">
                        <div class="flex-shrink-0">
                            @if($subSection->placementable_type === 'App\Models\Article')
                                <svg class="w-5 h-5 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            @elseif($subSection->placementable_type === 'App\Models\Book')
                                <svg class="w-5 h-5 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25" />
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-sky-800 hover:text-sky-900 leading-tight">{{ $subSection->title }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div> {{-- конец x-data --}}
    @else
        <p class="text-center text-gray-500">В этом разделе пока нет материалов.</p>
    @endif
</x-layout>
