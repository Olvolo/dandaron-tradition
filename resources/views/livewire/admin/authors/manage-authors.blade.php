<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Управление авторами</h1>
        <button wire:click="create()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Создать автора</button>
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Имя</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($authors as $author)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $author->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $author->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button wire:click="edit({{ $author->id }})" class="text-indigo-600 hover:text-indigo-900">Редактировать</button>
                        <button wire:click="delete({{ $author->id }})" wire:confirm="Вы уверены, что хотите удалить этого автора?" class="text-red-600 hover:text-red-900 ml-4">Удалить</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                        Авторы пока не добавлены.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg">
                <h2 class="text-xl font-bold mb-4">{{ $author_id ? 'Редактировать автора' : 'Создать нового автора' }}</h2>
                <form>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Имя</label>
                        <input type="text" id="name" wire:model.defer="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="bio" class="block text-sm font-medium text-gray-700">Биография</label>
                        <textarea id="bio" wire:model.defer="bio" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="image_path" class="block text-sm font-medium text-gray-700">Путь к изображению (например, authors/photo.jpg)</label>
                        <input type="text" id="image_path" wire:model.defer="image_path" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </form>
                <div class="flex justify-end space-x-4 mt-6">
                    <button wire:click="closeModal()" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Отмена</button>
                    <button wire:click.prevent="store()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Сохранить</button>
                </div>
            </div>
        </div>
    @endif
</div>
