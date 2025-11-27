<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['item', 'level' => 0]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['item', 'level' => 0]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $children = $item->children ?? collect();
    $hasChildren = $children->isNotEmpty();

    $currentPath = trim(request()->path(), '/');
    $itemPath = trim($item->full_slug, '/');

    $isActive = ($currentPath === $itemPath);

    // Правильная проверка предка, включая корень
    if ($itemPath === '') {
        $isAncestorOfActive = ($currentPath !== ''); // Главная — предок всего, кроме "/"
    } else {
        $isAncestorOfActive = str_starts_with($currentPath, $itemPath . '/');
    }

    $isExpanded = $isActive || $isAncestorOfActive;
    $paddingLeft = 0.25 + ($level * 0.75);
?>

<div x-data="{ open: <?php echo \Illuminate\Support\Js::from($isExpanded)->toHtml() ?> }" class="py-1 border-b border-sky-300 last:border-b">
    <div class="flex items-center group hover:bg-sky-100/80 rounded-lg transition-all duration-200"
         style="padding-left: <?php echo e($paddingLeft); ?>rem">

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasChildren): ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isExpanded): ?>
                
                <span class="p-1.5">
                    <svg class="w-4 h-4 text-sky-600 rotate-90" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            <?php else: ?>
                
                <button @click.stop="open = !open" class="p-1.5 rounded-md hover:bg-sky-200/60 transition-colors">
                    <svg class="w-4 h-4 text-sky-600 transition-transform" :class="open ? 'rotate-90' : ''" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php else: ?>
            <span class="w-7 flex-shrink-0"></span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <a href="<?php echo e($item->full_slug === '' ? url('/') : url($item->full_slug)); ?>"
           class="flex-1 py-2 px-2 text-xs rounded-md transition-all duration-200
                  <?php echo e($isActive ? 'text-sky-900 font-semibold bg-sky-200/50 shadow-sm' : 'text-sky-700 hover:text-sky-900 hover:bg-sky-200/50'); ?>"
           style="min-width: 0;">
            <span class="block whitespace-normal break-words"><?php echo e($item->title); ?></span>
        </a>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasChildren): ?>
            <span class="text-xs font-medium text-sky-500 opacity-70 px-2.5 py-1 rounded-full bg-sky-200/50 mr-1.5">
                <?php echo e($children->count()); ?>

            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasChildren): ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isExpanded): ?>
            
            <div class="space-y-0.5 mt-0.5">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal68382ff5897471103dc79e4a4e923fa6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68382ff5897471103dc79e4a4e923fa6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tree-menu-item','data' => ['item' => $child,'level' => $level + 1]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tree-menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($child),'level' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($level + 1)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68382ff5897471103dc79e4a4e923fa6)): ?>
<?php $attributes = $__attributesOriginal68382ff5897471103dc79e4a4e923fa6; ?>
<?php unset($__attributesOriginal68382ff5897471103dc79e4a4e923fa6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68382ff5897471103dc79e4a4e923fa6)): ?>
<?php $component = $__componentOriginal68382ff5897471103dc79e4a4e923fa6; ?>
<?php unset($__componentOriginal68382ff5897471103dc79e4a4e923fa6); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php else: ?>
            
            <div x-show="open" x-collapse class="space-y-0.5 mt-0.5">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal68382ff5897471103dc79e4a4e923fa6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68382ff5897471103dc79e4a4e923fa6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tree-menu-item','data' => ['item' => $child,'level' => $level + 1]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tree-menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($child),'level' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($level + 1)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68382ff5897471103dc79e4a4e923fa6)): ?>
<?php $attributes = $__attributesOriginal68382ff5897471103dc79e4a4e923fa6; ?>
<?php unset($__attributesOriginal68382ff5897471103dc79e4a4e923fa6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68382ff5897471103dc79e4a4e923fa6)): ?>
<?php $component = $__componentOriginal68382ff5897471103dc79e4a4e923fa6; ?>
<?php unset($__componentOriginal68382ff5897471103dc79e4a4e923fa6); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views/components/tree-menu-item.blade.php ENDPATH**/ ?>