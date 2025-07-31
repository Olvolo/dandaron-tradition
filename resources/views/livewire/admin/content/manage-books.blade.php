<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Управление книгами</h1>
        <button wire:click="create()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Создать книгу</button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Название</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Авторы</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($books as $book)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $book->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $book->authors->pluck('name')->join(', ') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.books.edit', $book) }}" class="text-indigo-600 hover:text-indigo-900" wire:navigate>Редактировать</a>
                        <button wire:click="delete({{ $book->id }})" wire:confirm="Вы уверены?" class="text-red-600 hover:text-red-900 ml-4">Удалить</button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="p-4 text-center text-gray-500">Книги пока не добавлены.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">{{ $book_id ? 'Редактировать книгу' : 'Создать книгу' }}</h2>
                <form>
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Название</label>
                        <input type="text" id="title" wire:model.defer="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="annotation" class="block text-sm font-medium text-gray-700">Аннотация</label>
                        <textarea id="annotation" wire:model.defer="annotation" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
                        <textarea id="description" wire:model.defer="description" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="authors" class="block text-sm font-medium text-gray-700">Авторы</label>
                        <select id="authors" wire:model.defer="selectedAuthors" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" size="5">
                            @foreach($allAuthors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="custom_styles" class="block text-sm font-medium text-gray-700">Кастомные CSS-стили</label>
                        <textarea id="custom_styles" wire:model.defer="custom_styles" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm font-mono text-sm"></textarea>
                    </div>
                </form>
                <div class="flex justify-end space-x-4 mt-6 pt-4 border-t">
                    <button wire:click="closeModal()" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Отмена</button>
                    <button wire:click.prevent="store()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Сохранить</button>
                </div>
            </div>
        </div>
    @endif
</div>
