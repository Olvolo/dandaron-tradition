<div>
    <div class="mb-6">
        <a href="{{ route('admin.books.index') }}" class="text-sm text-blue-600 hover:underline" wire:navigate>&larr; Назад к списку книг</a>
        <h1 class="text-2xl font-bold mt-2">Редактирование книги: {{ $book->title }}</h1>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">Данные книги</h2>
        <form wire:submit.prevent="updateBook">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Название</label>
                        <input type="text" id="title" wire:model.defer="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="authors" class="block text-sm font-medium text-gray-700">Авторы</label>
                        <select id="authors" wire:model.defer="selectedAuthors" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" size="5">
                            @foreach($allAuthors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <div class="mb-4">
                        <label for="annotation" class="block text-sm font-medium text-gray-700">Аннотация</label>
                        <textarea id="annotation" wire:model.defer="annotation" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
                <textarea id="description" wire:model.defer="description" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
            </div>
            <div class="mt-4">
                <label for="custom_styles" class="block text-sm font-medium text-gray-700">Кастомные CSS-стили</label>
                <textarea id="custom_styles" wire:model.defer="custom_styles" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm font-mono text-sm"></textarea>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Сохранить изменения</button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Главы книги</h2>
            <button wire:click="createChapter()" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">Добавить главу</button>
        </div>

        @if (session()->has('chapter_message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('chapter_message') }}</span>
            </div>
        @endif

        @if($rootChapters->isEmpty())
            <p class="text-center text-gray-500">В этой книге пока нет глав.</p>
        @else
            <ul class="space-y-2">
                @foreach ($rootChapters as $chapter)
                    @include('livewire.admin.content.chapter-item', ['chapter' => $chapter])
                @endforeach
            </ul>
        @endif
    </div>

    @if ($isChapterModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-4xl">
                <h2 class="text-xl font-bold mb-4">{{ $chapter_id ? 'Редактировать главу' : 'Создать главу' }}</h2>
                <form>
                    <div class="mb-4">
                        <label for="chapter_title" class="block text-sm font-medium text-gray-700">Название главы</label>
                        <input type="text" id="chapter_title" wire:model.defer="chapter_title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="chapter_order_column" class="block text-sm font-medium text-gray-700">Порядок</label>
                        <input type="number" id="chapter_order_column" wire:model.defer="chapter_order_column" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="chapter_content_html" class="block text-sm font-medium text-gray-700">HTML-код Главы</label>
                        <textarea id="chapter_content_html" wire:model.defer="chapter_content_html" rows="15" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm font-mono text-sm"></textarea>
                    </div>
                </form>
                <div class="flex justify-end space-x-4 mt-6 pt-4 border-t">
                    <button wire:click="closeChapterModal()" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Отмена</button>
                    <button wire:click.prevent="storeChapter()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Сохранить</button>
                </div>
            </div>
        </div>
    @endif
</div>
