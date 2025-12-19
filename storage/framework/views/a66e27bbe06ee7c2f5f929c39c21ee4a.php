<div>
    <div class="mb-6">
        <a href="<?php echo e(route('admin.books.index')); ?>" class="text-sm text-blue-600 hover:underline" wire:navigate>&larr; Назад к списку книг</a>
        <h1 class="text-2xl font-bold mt-2">Редактирование книги: <?php echo e($book->title); ?></h1>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('message')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?php echo e(session('message')); ?></span>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

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
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $allAuthors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($author->id); ?>"><?php echo e($author->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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

    
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.content.manage-chapters', ['book' => $book]);

$key = null;

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1015657165-0', null);

$__html = app('livewire')->mount($__name, $__params, $key);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

</div>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\livewire\admin\content\book-edit.blade.php ENDPATH**/ ?>