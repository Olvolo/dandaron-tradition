<?php
    $padding = ($level ?? 0) * 2;
    $headingLevel = 2 + ($level ?? 0);
?>

<div style="padding-left: <?php echo e($padding); ?>rem;" class="mt-8 scroll-mt-20">
    <?php echo "<h".$headingLevel." id=\"chapter-$chapter->slug\" class=\"text-2xl font-bold mb-4 text-center\">"; ?>    <?php echo e($chapter->title); ?>

    <?php echo "</h".$headingLevel.">"; ?>


    <div class="prose prose-lg max-w-none">
        <?php echo $chapter->content_html; ?>

    </div>
</div>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($chapter->children->isNotEmpty()): ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $chapter->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('pages.partials.chapter-content', ['chapter' => $child, 'level' => ($level ?? 0) + 1], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\pages\partials\chapter-content.blade.php ENDPATH**/ ?>