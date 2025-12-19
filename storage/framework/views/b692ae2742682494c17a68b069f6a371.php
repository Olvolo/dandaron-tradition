<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Управление статьями</h1>
        <button wire:click="create()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Создать статью</button>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('message')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?php echo e(session('message')); ?></span>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr wire:key="article-<?php echo e($article->id); ?>">
                    <td class="px-6 py-4 whitespace-nowrap font-medium"><?php echo e($article->title); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?php echo e($article->parent->title ?? '—'); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button wire:click="edit(<?php echo e($article->id); ?>)" class="text-indigo-600 hover:text-indigo-900">Редактировать</button>
                        <button wire:click="delete(<?php echo e($article->id); ?>)" wire:confirm="Вы уверены?" class="text-red-600 hover:text-red-900 ml-4">Удалить</button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="3" class="p-4 text-center text-gray-500">Статьи пока не добавлены.</td></tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        <?php echo e($articles->links()); ?>

    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isModalOpen): ?>
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-[95vw] max-h-[90vh] overflow-y-auto">
                <h2 class="text-xl font-bold mb-4"><?php echo e($article_id ? 'Редактировать статью' : 'Создать статью'); ?></h2>
                <form>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 overflow-hidden">
                        <div class="space-y-4 min-w-0">
                            <div class="min-w-0">
                                <label for="title" class="block text-sm font-medium text-gray-700">Заголовок</label>
                                <input type="text" id="title" wire:model.defer="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm resize-x min-w-[200px] max-w-full">
                            </div>
                            <div class="min-w-0">
                                <label for="annotation" class="block text-sm font-medium text-gray-700">Аннотация</label>
                                <textarea id="annotation" wire:model.defer="annotation" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm resize min-w-[200px] min-h-[3rem] max-w-full"></textarea>
                            </div>
                            <div class="min-w-0">
                                <label for="parent_id" class="block text-sm font-medium text-gray-700">Родительский раздел</label>
                                <select id="parent_id" wire:model.defer="parent_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm min-w-[200px] max-w-full">
                                    <option value=""> — Нет — </option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $potentialParents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($parent->id); ?>"><?php echo e($parent->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                            <div class="min-w-0">
                                <label for="content_html" class="block text-sm font-medium text-gray-700">HTML-код Контента</label>
                                <textarea id="content_html" wire:model.defer="content_html" rows="15" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm font-mono text-sm resize min-w-[200px] min-h-[15rem] max-w-full"></textarea>
                            </div>
                            <div class="min-w-0">
                                <label for="custom_styles" class="block text-sm font-medium text-gray-700">Кастомные CSS-стили</label>
                                <textarea id="custom_styles" wire:model.defer="custom_styles" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm font-mono text-sm resize min-w-[200px] min-h-[5rem] max-w-full"></textarea>
                            </div>
                        </div>
                        <div class="space-y-4 min-w-0">
                            <div class="min-w-0">
                                <label for="authors" class="block text-sm font-medium text-gray-700">Авторы</label>
                                <select id="authors" wire:model.defer="selectedAuthors" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm resize min-h-[8rem] min-w-[200px] max-w-full">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $allAuthors->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($author->id); ?>"><?php echo e($author->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                                <p class="mt-1 text-xs text-gray-500">Удерживайте Ctrl (Cmd на Mac) для выбора нескольких элементов</p>
                            </div>
                            <div class="min-w-0">
                                <label for="categories" class="block text-sm font-medium text-gray-700">Категории</label>
                                <select id="categories" wire:model.defer="selectedCategories" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm resize min-h-[8rem] min-w-[200px] max-w-full">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $allCategories->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                                <p class="mt-1 text-xs text-gray-500">Удерживайте Ctrl (Cmd на Mac) для выбора нескольких элементов</p>
                            </div>
                            <div class="min-w-0">
                                <label for="tags" class="block text-sm font-medium text-gray-700">Теги</label>
                                <select id="tags" wire:model.defer="selectedTags" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm resize min-h-[8rem] min-w-[200px] max-w-full">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $allTags->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tag->id); ?>"><?php echo e($tag->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                                <p class="mt-1 text-xs text-gray-500">Удерживайте Ctrl (Cmd на Mac) для выбора нескольких элементов</p>
                            </div>
                            <div class="min-w-0">
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
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>


<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\livewire\admin\content\manage-articles.blade.php ENDPATH**/ ?>