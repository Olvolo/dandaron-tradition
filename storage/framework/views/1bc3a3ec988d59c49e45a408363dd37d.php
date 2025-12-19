<li class="border rounded-md">
    <div class="flex justify-between items-center p-3">
        <div class="flex items-center">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($chapter->children->isNotEmpty()): ?>
                <button wire:click="$toggle('open')" class="mr-2 text-gray-500 hover:text-gray-800">
                    <svg class="h-4 w-4 transform transition-transform <?php if($open): ?> rotate-90 <?php endif; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </button>
            <?php else: ?>
                <div class="w-6 mr-2"></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <span class="font-semibold"><?php echo e($chapter->title); ?></span>
        </div>
        <div class="space-x-2 text-sm">
            <button wire:click="createChildChapter" class="text-green-600 hover:text-green-900">Добавить под-главу</button>
            <button wire:click="editChapter" class="text-indigo-600 hover:text-indigo-900">Редакт.</button>
            <button wire:click="deleteChapter" wire:confirm="Вы уверены?" class="text-red-600 hover:text-red-900">Удалить</button>
        </div>
    </div>
    <?php if($chapter->children->isNotEmpty() && $open): ?>
        <div class="pl-6 border-t">
            <ul class="py-2 space-y-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $chapter->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.content.chapter-item', ['chapter' => $child]);

$key = 'sub-chapter-'.$child->id;

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2368806726-0', 'sub-chapter-'.$child->id);

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
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</li>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views/livewire/admin/content/chapter-item.blade.php ENDPATH**/ ?>