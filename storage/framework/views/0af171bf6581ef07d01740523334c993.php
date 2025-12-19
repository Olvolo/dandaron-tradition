<div class="bg-white shadow-md rounded-lg p-6 mt-8">
    
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Главы книги</h2>
        <button wire:click="createChapter" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">Добавить главу</button>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('chapter_message')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?php echo e(session('chapter_message')); ?></span>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rootChapters->isNotEmpty()): ?>
        <ul class="space-y-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $rootChapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.content.chapter-item', ['chapter' => $chapter]);

$key = 'chapter-'.$chapter->id;

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3788751231-0', 'chapter-'.$chapter->id);

$__html = app('livewire')->mount($__name, $__params, $key);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </ul>
    <?php else: ?>
        <p class="text-sky-600">Глав пока нет.</p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isChapterModalOpen): ?>
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div @click.away="closeChapterModal" class="bg-sky-50 rounded-lg shadow-xl p-6 w-full
            max-w-4xl">
                <h2 class="text-xl font-bold mb-4"><?php echo e($chapter_id ? 'Редактировать главу' : 'Создать главу'); ?></h2>
                <form>
                    <div class="mb-4">
                        <label for="chapter_title" class="block text-sm font-medium text-sky-800">Название главы</label>
                        <input type="text" id="chapter_title" wire:model.defer="chapter_title"
                               class="mt-1 block w-full border-sky-400 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="chapter_order_column" class="block text-sm font-medium text-sky-800">Порядок</label>
                        <input type="number" id="chapter_order_column" wire:model.defer="chapter_order_column" class="mt-1 block w-full border-sky-400 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="chapter_content_html" class="block text-sm font-medium text-sky-800">HTML-код Главы</label>
                        <textarea id="chapter_content_html" wire:model.defer="chapter_content_html" rows="15" class="mt-1 block w-full border-sky-400 rounded-md shadow-sm font-mono text-sm"></textarea>
                    </div>
                </form>
                <div class="flex justify-end space-x-4 mt-6 pt-4 border-t">
                    <button wire:click="closeChapterModal" class="px-4 py-2 bg-sky-400 rounded-md
                    hover:bg-sky-500">Отмена</button>
                    <button wire:click.prevent="storeChapter" class="px-4 py-2 bg-blue-600 text-sky-50
                     rounded-md hover:bg-blue-700">Сохранить</button>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\livewire\admin\content\manage-chapters.blade.php ENDPATH**/ ?>