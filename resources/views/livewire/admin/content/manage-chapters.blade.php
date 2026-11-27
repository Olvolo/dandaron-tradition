<div class="bg-white shadow-md rounded-lg p-6 mt-8">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Главы книги</h2>

        <button
            type="button"
            wire:click="createChapter"
            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm"
        >
            Добавить главу
        </button>
    </div>

    {{-- Сообщение об успешном действии --}}
    @if (session()->has('chapter_message'))
        <div
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
            role="alert"
        >
            {{ session('chapter_message') }}
        </div>
    @endif

    {{-- Сообщение об ошибке --}}
    @if (session()->has('chapter_error'))
        <div
            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
            role="alert"
        >
            {{ session('chapter_error') }}
        </div>
    @endif

    {{-- Дерево глав --}}
    @if ($rootChapters->isNotEmpty())

        <ul class="space-y-2">
            @foreach ($rootChapters as $chapter)
                <livewire:admin.content.chapter-item
                    :chapter="$chapter"
                    :key="'chapter-'.$chapter->id"
                />
            @endforeach
        </ul>

    @else

        <p class="text-sky-600">Глав пока нет.</p>

    @endif

    {{-- Модальное окно создания и редактирования главы --}}
    @if ($isChapterModalOpen)

        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">

            <div
                x-on:click.outside="$wire.closeChapterModal()"
                class="bg-sky-50 rounded-lg shadow-xl p-6 w-full max-w-4xl max-h-[90vh] overflow-y-auto"
            >

                <h2 class="text-xl font-bold mb-4">
                    {{ $chapter_id ? 'Редактировать главу' : 'Создать главу' }}
                </h2>

                <form wire:submit.prevent="storeChapter">

                    {{-- Название главы --}}
                    <div class="mb-4">

                        <label
                            for="chapter_title"
                            class="block text-sm font-medium text-sky-800"
                        >
                            Название главы
                        </label>

                        <input
                            type="text"
                            id="chapter_title"
                            wire:model.defer="chapter_title"
                            class="mt-1 block w-full border border-sky-400 rounded-md shadow-sm"
                        >

                        @error('chapter_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Порядок главы --}}
                    <div class="mb-4">

                        <label
                            for="chapter_order_column"
                            class="block text-sm font-medium text-sky-800"
                        >
                            Порядок
                        </label>

                        <input
                            type="number"
                            id="chapter_order_column"
                            wire:model.defer="chapter_order_column"
                            class="mt-1 block w-full border border-sky-400 rounded-md shadow-sm"
                        >

                        @error('chapter_order_column')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- HTML-содержимое главы --}}
                    <div class="mb-4">

                        <label
                            for="chapter_content_html"
                            class="block text-sm font-medium text-sky-800"
                        >
                            HTML-код главы
                        </label>

                        <textarea
                            id="chapter_content_html"
                            wire:model.defer="chapter_content_html"
                            rows="15"
                            class="mt-1 block w-full border border-sky-400 rounded-md shadow-sm font-mono text-sm"
                        ></textarea>

                        @error('chapter_content_html')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Дополнительные стили --}}
                    <div class="mb-4">

                        <label
                            for="custom_styles"
                            class="block text-sm font-medium text-sky-800"
                        >
                            Дополнительные стили главы
                        </label>

                        <textarea
                            id="custom_styles"
                            wire:model.defer="custom_styles"
                            rows="5"
                            class="mt-1 block w-full border border-sky-400 rounded-md shadow-sm font-mono text-sm"
                        ></textarea>

                        @error('custom_styles')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Общая ошибка родительской связи --}}
                    @error('chapter_parent_id')
                        <div class="mb-4 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror

                    {{-- Кнопки --}}
                    <div class="flex justify-end space-x-4 mt-6 pt-4 border-t">

                        <button
                            type="button"
                            wire:click="closeChapterModal"
                            class="px-4 py-2 bg-sky-400 rounded-md hover:bg-sky-500"
                        >
                            Отмена
                        </button>

                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="storeChapter"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50"
                        >
                            <span wire:loading.remove wire:target="storeChapter">
                                Сохранить
                            </span>

                            <span wire:loading wire:target="storeChapter">
                                Сохранение...
                            </span>
                        </button>

                    </div>

                </form>

            </div>

        </div>

    @endif

</div>
