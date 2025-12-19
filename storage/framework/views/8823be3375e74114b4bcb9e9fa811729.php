<div>
    <h1 class="text-2xl font-bold mb-6">Управление категориями и тегами</h1>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('message')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?php echo e(session('message')); ?></span>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Категории</h2>
                <button wire:click="create('Category')" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">Создать категорию</button>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-sky-300">
                    <thead class="bg-sky-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-sky-100 uppercase tracking-wider">Название</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-sky-100 uppercase tracking-wider">Действия</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-sky-300">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr wire:key="category-<?php echo e($category->id); ?>">
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($category->name); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button wire:click="edit('Category', <?php echo e($category->id); ?>)" class="text-indigo-600 hover:text-indigo-900">Ред.</button>
                                <button wire:click="delete('Category', <?php echo e($category->id); ?>)" wire:confirm="Вы уверены?" class="text-red-600 hover:text-red-900 ml-4">Удал.</button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="2" class="p-4 text-center text-sky-100">Нет категорий.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                <table class="min-w-full divide-y divide-sky-300">
                    <thead class="bg-sky-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-sky-100 uppercase tracking-wider">Название</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-sky-100 uppercase tracking-wider">Действия</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-sky-300">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr wire:key="tag-<?php echo e($tag->id); ?>">
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($tag->name); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button wire:click="edit('Tag', <?php echo e($tag->id); ?>)" class="text-indigo-600 hover:text-indigo-900">Ред.</button>
                                <button wire:click="delete('Tag', <?php echo e($tag->id); ?>)" wire:confirm="Вы уверены?" class="text-red-600 hover:text-red-900 ml-4">Удал.</button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="2" class="p-4 text-center text-sky-100">Нет тегов.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isModalOpen): ?>
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg">
                <h2 class="text-xl font-bold mb-4"><?php echo e($itemId ? 'Редактировать' : 'Создать'); ?> <?php echo e($modelType === 'Category' ? 'категорию' : 'тег'); ?></h2>
                <form>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-sky-800">Название</label>
                        <input type="text" id="name" wire:model.lazy="name" class="mt-1 block w-full border-sky-400 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </form>
                <div class="flex justify-end space-x-4 mt-6">
                    <button wire:click="closeModal()" class="px-4 py-2 bg-sky-400 rounded-md hover:bg-sky-500">Отмена</button>
                    <button wire:click.prevent="store()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Сохранить</button>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\livewire\admin\taxonomy\manage-taxonomy.blade.php ENDPATH**/ ?>