<?php use App\Models\Placement; ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['items' => null]));

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

foreach (array_filter((['items' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    // Используем database кеш с правильным ключом
    $menuItems = $items ?? cache()->remember('menu_tree_optimized', 3600, function () {
        return Placement::whereNull('parent_id')
            ->select('id', 'parent_id', 'title', 'full_slug')
            ->with(['children' => function($query) {
                $query->select('id', 'parent_id', 'title', 'full_slug')
                    ->orderBy('order_column')
                    ->with(['children' => function($q) {
                        $q->select('id', 'parent_id', 'title', 'full_slug')
                            ->orderBy('order_column')
                            ->with(['children' => function($q2) {
                                $q2->select('id', 'parent_id', 'title', 'full_slug')
                                    ->orderBy('order_column');
                            }]);
                    }]);
            }])
            ->orderBy('order_column')
            ->get();
    });
?>

<div class="divide-y divide-sky-100/50">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if (isset($component)) { $__componentOriginal68382ff5897471103dc79e4a4e923fa6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68382ff5897471103dc79e4a4e923fa6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tree-menu-item','data' => ['item' => $item,'level' => 0]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tree-menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item),'level' => 0]); ?>
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
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\components\tree-menu.blade.php ENDPATH**/ ?>