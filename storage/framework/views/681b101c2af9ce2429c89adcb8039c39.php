<li class="border rounded-md">
    <div>
        <div class="flex justify-between items-center p-3">
            <div class="flex items-center">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($placement->children->isNotEmpty()): ?>
                    <button wire:click="$toggle('open')" class="mr-2 text-sky-600 hover:text-sky-900">
                        <svg class="h-4 w-4 transform transition-transform" <?php if($open): ?> style="transform: rotate(90deg);" <?php endif; ?> fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                <?php else: ?>
                    <div class="w-6 mr-2"></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div>
                    <span class="font-semibold"><?php echo e($placement->title); ?></span>
                    <span class="ml-2 text-sm text-sky-600 font-mono">/<?php echo e($placement->slug); ?></span>
                </div>
            </div>
            <div class="space-x-2 text-sm">
                <button wire:click="createChildPlacement" class="text-green-600 hover:text-green-900">Добавить</button>
                <button wire:click="editPlacement" class="text-indigo-600 hover:text-indigo-900">Редакт.</button>
                <button wire:click="deletePlacement" wire:confirm="Вы уверены?" class="text-red-600 hover:text-red-900">Удалить</button>
            </div>
        </div>
        <?php if($placement->children->isNotEmpty() && $open): ?>
            <div class="pl-6 border-t">
                <ul class="py-2 space-y-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $placement->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.structure.placement-item', ['placement' => $child]);

$key = 'sub-placement-'.$child->id;

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3100216376-0', 'sub-placement-'.$child->id);

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
    </div>
</li>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\livewire\admin\structure\placement-item.blade.php ENDPATH**/ ?>