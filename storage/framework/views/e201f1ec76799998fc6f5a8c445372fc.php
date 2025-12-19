<footer class="bg-sky-400 py-1 mt-1">
    <div class="container mx-auto px-4 md:px-6 text-center text-sky-50">
        <div class="flex justify-center mb-0">
            <?php if (isset($component)) { $__componentOriginal854cb71daa397afc43c1a0471f57a43e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal854cb71daa397afc43c1a0471f57a43e = $attributes; } ?>
<?php $component = App\View\Components\FooterNavigation::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer-navigation'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FooterNavigation::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal854cb71daa397afc43c1a0471f57a43e)): ?>
<?php $attributes = $__attributesOriginal854cb71daa397afc43c1a0471f57a43e; ?>
<?php unset($__attributesOriginal854cb71daa397afc43c1a0471f57a43e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal854cb71daa397afc43c1a0471f57a43e)): ?>
<?php $component = $__componentOriginal854cb71daa397afc43c1a0471f57a43e; ?>
<?php unset($__componentOriginal854cb71daa397afc43c1a0471f57a43e); ?>
<?php endif; ?>
        </div>
        <p class="text-xs text-sky-900/90 mt-1">&copy; <?php echo e(date('Y')); ?> Dandaron Tradition. All
            Rights
            Reserved.</p>
    </div>
</footer>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\layouts\partials\footer.blade.php ENDPATH**/ ?>