<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Структура Сайта</h1>
        <button wire:click="create()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Добавить корневой элемент
        </button>
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
                    <livewire:admin.structure.placement-item
                        :placement="$placement"
                        :key="'placement-'.$placement->id"
                    />
                @endforeach
            </ul>
        @endif
    </div>

    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">
                    {{ $placement_id ? 'Редактировать элемент' : 'Создать элемент' }}
                </h2>

                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Левая колонка -->
                        <div>
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Название</label>
                                <input
                                    type="text"
                                    id="title"
                                    wire:model.defer="title"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                >
                                @error('title')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug (URL)</label>
                                    <input
                                        type="text"
                                        id="slug"
                                        wire:model.defer="slug"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                        placeholder="Авто"
                                    >
                                    @error('slug')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="order_column" class="block text-sm font-medium text-gray-700">Порядок</label>
                                    <input
                                        type="number"
                                        id="order_column"
                                        wire:model.defer="order_column"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    >
                                    @error('order_column')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>{{-- НОВЫЙ БЛОК: Выбор родительского элемента --}}
                            <div class="mt-4">
                                <label for="parent_id" class="block text-sm font-medium text-gray-700">Родительский элемент</label>
                                <select id="parent_id" wire:model.defer="parent_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">-- Нет (Корневой элемент) --</option>
                                    {{-- Мы будем использовать рекурсивный компонент для отображения дерева --}}
                                    @foreach(\App\Models\Placement::whereNull('parent_id')->orderBy('order_column')->get() as $rootPlacement)
                                        @include('livewire.admin.structure.placement-option', ['placement' => $rootPlacement, 'level' => 0])
                                    @endforeach
                                </select>
                            </div>



                            <!-- Чекбоксы -->
                            <div class="flex flex-wrap gap-6 mb-4">
                                <div class="flex items-center">
                                    <input
                                        id="show_in_menu"
                                        wire:model.defer="show_in_menu"
                                        type="checkbox"
                                        class="h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                    >
                                    <label for="show_in_menu" class="ml-2 block text-sm text-gray-900">
                                        Показывать в меню
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        id="show_on_main"
                                        wire:model.defer="show_on_main"
                                        type="checkbox"
                                        class="h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                    >
                                    <label for="show_on_main" class="ml-2 block text-sm text-gray-900">
                                        Показывать на главной
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        id="is_protected"
                                        wire:model.defer="is_protected"
                                        type="checkbox"
                                        class="h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                    >
                                    <label for="is_protected" class="ml-2 block text-sm text-gray-900">
                                        Защищено (только для вошедших)
                                    </label>
                                </div>
                            </div>

                            <!-- Поля для фона и стилей -->
                            <div class="space-y-4">
                                <div>
                                    <label for="background_image_url" class="block text-sm font-medium text-gray-700">
                                        URL фонового изображения
                                    </label>
                                    <input
                                        type="text"
                                        id="background_image_url"
                                        wire:model.defer="background_image_url"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    >
                                </div>

                                <div>
                                    <label for="custom_styles" class="block text-sm font-medium text-gray-700">
                                        Кастомные CSS-стили
                                    </label>
                                    <textarea
                                        id="custom_styles"
                                        wire:model.defer="custom_styles"
                                        rows="5"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm font-mono"
                                    ></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Правая колонка -->
                        <div class="border-l pl-6">
                            <h3 class="font-semibold text-gray-800">Привязать контент</h3>
                            <p class="text-sm text-gray-500 mb-4">Выберите либо статью, либо книгу.</p>

                            <div class="mb-4">
                                <label for="link_article" class="block text-sm font-medium text-gray-700">Статья</label>
                                <select
                                    id="link_article"
                                    wire:model="article_link_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                >
                                    <option value="">— Не выбрано —</option>
                                    @foreach ($articles as $article)
                                        <option value="{{ $article->id }}">{{ $article->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="link_book" class="block text-sm font-medium text-gray-700">Книга</label>
                                <select
                                    id="link_book"
                                    wire:model="book_link_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                >
                                    <option value="">— Не выбрано —</option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="flex justify-end space-x-4 mt-6 pt-4 border-t">
                    <button
                        wire:click="closeModal()"
                        class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400"
                    >
                        Отмена
                    </button>
                    <button
                        wire:click.prevent="store()"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                    >
                        Сохранить
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
