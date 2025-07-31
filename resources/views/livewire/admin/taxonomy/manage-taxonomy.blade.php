<div>
    <h1 class="text-2xl font-bold mb-6">Управление категориями и тегами</h1>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Категории</h2>
                <button wire:click="create('Category')" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">Создать категорию</button>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Название</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($categories as $category)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $category->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button wire:click="edit('Category', {{ $category->id }})" class="text-indigo-600 hover:text-indigo-900">Ред.</button>
                                <button wire:click="delete('Category', {{ $category->id }})" wire:confirm="Вы уверены?" class="text-red-600 hover:text-red-900 ml-4">Удал.</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="p-4 text-center text-gray-500">Нет категорий.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Теги</h2>
                <button wire:click="create('Tag')" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">Создать тег</button>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Название</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($tags as $tag)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $tag->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button wire:click="edit('Tag', {{ $tag->id }})" class="text-indigo-600 hover:text-indigo-900">Ред.</button>
                                <button wire:click="delete('Tag', {{ $tag->id }})" wire:confirm="Вы уверены?" class="text-red-600 hover:text-red-900 ml-4">Удал.</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="p-4 text-center text-gray-500">Нет тегов.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg">
                <h2 class="text-xl font-bold mb-4">{{ $itemId ? 'Редактировать' : 'Создать' }} {{ $modelType === 'Category' ? 'категорию' : 'тег' }}</h2>
                <form>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Название</label>
                        <input type="text" id="name" wire:model.lazy="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
