<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Структура Сайта</h1>
        <button wire:click="create()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Добавить корневой элемент</button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6">
        @if($placements->isEmpty())
            <p class="text-center text-gray-500">Структура сайта пока пуста.</p>
        @else
            <ul class="space-y-2">
                @foreach ($placements as $placement)
                    @include('livewire.admin.structure.placement-item', ['item' => $placement])
                @endforeach
            </ul>
        @endif
    </div>

    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">{{ $placement_id ? 'Редактировать элемент' : 'Создать элемент' }}</h2>
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Название</label>
                                <input type="text" id="title" wire:model.defer="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug (URL)</label>
                                    <input type="text" id="slug" wire:model.defer="slug" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Авто">
                                    @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="order_column" class="block text-sm font-medium text-gray-700">Порядок</label>
                                    <input type="number" id="order_column" wire:model.defer="order_column" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    @error('order_column') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="flex items-start mt-6 space-x-8">
                                <div class="flex items-center">
                                    <input id="show_in_menu" wire:model.defer="show_in_menu" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    <label for="show_in_menu" class="ml-2 block text-sm text-gray-900">Показывать в меню</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="show_on_main" wire:model.defer="show_on_main" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    <label for="show_on_main" class="ml-2 block text-sm text-gray-900">Показывать на главной</label>
                                </div>
                            </div>
                        </div>
                        <div class="border-l pl-6">
                            <h3 class="font-semibold text-gray-800">Привязать контент</h3>
                            <p class="text-sm text-gray-500 mb-4">(Эта функция будет доступна после создания статей и книг)</p>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-500">Статья</label>
                                <select disabled class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm">
                                    <option>Нет доступных статей</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-500">Книга</label>
                                <select disabled class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm">
                                    <option>Нет доступных книг</option>
                                </select>
                            </div>
                        </div>
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
