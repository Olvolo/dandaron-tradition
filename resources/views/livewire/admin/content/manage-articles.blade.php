<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Управление статьями</h1>
        <button wire:click="create()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Создать статью</button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Заголовок</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Родительский раздел</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($articles as $article)
                <tr wire:key="article-{{ $article->id }}">
                    <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $article->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $article->parent->title ?? '—' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button wire:click="edit({{ $article->id }})" class="text-indigo-600 hover:text-indigo-900">Редактировать</button>
                        <button wire:click="delete({{ $article->id }})" wire:confirm="Вы уверены?" class="text-red-600 hover:text-red-900 ml-4">Удалить</button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="p-4 text-center text-gray-500">Статьи пока не добавлены.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-4xl">
                <h2 class="text-xl font-bold mb-4">{{ $article_id ? 'Редактировать статью' : 'Создать статью' }}</h2>
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
                        <div>
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Заголовок</label>
                                <input type="text" id="title" wire:model.defer="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div class="mb-4">
                                <label for="annotation" class="block text-sm font-medium text-gray-700">Аннотация</label>
                                <textarea id="annotation" wire:model.defer="annotation" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="parent_id" class="block text-sm font-medium text-gray-700">Родительский раздел</label>
                                <select id="parent_id" wire:model.defer="parent_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value=""> — Нет — </option>
                                    @foreach ($potentialParents as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="content_html" class="block text-sm font-medium text-gray-700">HTML-код Контента</label>
                                <textarea id="content_html" wire:model.defer="content_html" rows="15" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm font-mono text-sm"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="custom_styles" class="block text-sm font-medium text-gray-700">Кастомные CSS-стили</label>
                                <textarea id="custom_styles" wire:model.defer="custom_styles" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm font-mono text-sm"></textarea>
                            </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <label for="authors" class="block text-sm font-medium text-gray-700">Авторы</label>
                                <select id="authors" wire:model.defer="selectedAuthors" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" size="5">
                                    @foreach($allAuthors as $author)
                                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="categories" class="block text-sm font-medium text-gray-700">Категории</label>
                                <select id="categories" wire:model.defer="selectedCategories" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" size="5">
                                    @foreach($allCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="tags" class="block text-sm font-medium text-gray-700">Теги</label>
                                <select id="tags" wire:model.defer="selectedTags" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" size="5">
                                    @foreach($allTags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <div class="flex items-center">
                                    <input id="is_protected_article" wire:model.defer="is_protected" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    <label for="is_protected_article" class="ml-2 block text-sm text-gray-900">Защищено (только для вошедших)</label>
                                </div>
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
