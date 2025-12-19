<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', 'HTML Песочница'); ?>

    
    <div x-data="{ sourceHtml: '<h1>Введите ваш HTML здесь</h1><p>И он появится справа.</p>' }" class="flex flex-col flex-grow">

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-grow">

            
            <div class="flex flex-col">
                <label for="source" class="block text-lg font-medium text-gray-700 mb-2">HTML-код</label>
                <textarea
                    id="source"
                    x-model="sourceHtml"
                    class="w-full h-full flex-grow p-4 border-gray-300 rounded-md shadow-sm font-mono text-sm focus:ring-sky-500 focus:border-sky-500"
                ></textarea>
            </div>

            
            <div class="flex flex-col">
                <label class="block text-lg font-medium text-gray-700 mb-2">Предпросмотр</label>
                <div class="w-full h-full p-8 bg-white/80 rounded-lg shadow-inner overflow-y-auto">
                    <div class="prose prose-lg max-w-none" x-html="sourceHtml"></div>
                </div>
            </div>

        </div>
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
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\pages\sandbox.blade.php ENDPATH**/ ?>