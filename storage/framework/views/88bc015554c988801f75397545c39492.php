<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['item']));

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

foreach (array_filter((['item']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    // Определяем, что за контент нам передали, и получаем нужные данные
    $displayItem = $item->placementable ?? $item;
    $url = url($item->full_slug ?? '#');
    $type = match($item->placementable_type) {
        'App\\Models\\Article' => 'Статья',
        'App\\Models\\Book' => 'Книга',
        default => 'Раздел',
    };
?>

<a href="<?php echo e($url); ?>" class="content-card group">
    <h3>
        <span class="line-clamp-3"><?php echo e($displayItem->title); ?></span>
    </h3>
    <p class="card-type">
        <?php echo e($type); ?>

    </p>
</a>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\components\content-card.blade.php ENDPATH**/ ?>