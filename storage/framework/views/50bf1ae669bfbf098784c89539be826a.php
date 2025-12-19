<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['content' => $chapter]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['content' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($chapter)]); ?>  <!-- Передаём $chapter как content -->
    <div class="bg-white/80 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl text-center font-bold mb-4"><?php echo e($chapter->title); ?></h1>

        <div class="prose prose-lg max-w-none">
            <?php echo $chapter->content_html; ?>

        </div>

        <?php if (isset($component)) { $__componentOriginal8f9ef6cd39e4de797da6453698d126c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8f9ef6cd39e4de797da6453698d126c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.book-toc','data' => ['book' => $book]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('book-toc'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['book' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($book)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8f9ef6cd39e4de797da6453698d126c7)): ?>
<?php $attributes = $__attributesOriginal8f9ef6cd39e4de797da6453698d126c7; ?>
<?php unset($__attributesOriginal8f9ef6cd39e4de797da6453698d126c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8f9ef6cd39e4de797da6453698d126c7)): ?>
<?php $component = $__componentOriginal8f9ef6cd39e4de797da6453698d126c7; ?>
<?php unset($__componentOriginal8f9ef6cd39e4de797da6453698d126c7); ?>
<?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\pages\chapter.blade.php ENDPATH**/ ?>