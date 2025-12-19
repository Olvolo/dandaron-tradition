
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['inFooter' => false]));

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

foreach (array_filter((['inFooter' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<nav x-data="{ isOpen: false }" class="relative">

    <div class="hidden lg:flex items-center <?php echo e($inFooter ? 'space-x-4' : 'space-x-6'); ?>">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (isset($component)) { $__componentOriginal6cced52613a484e7295a90162a92d81b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6cced52613a484e7295a90162a92d81b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-item','data' => ['item' => $item,'inFooter' => $inFooter]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item),'in-footer' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($inFooter)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6cced52613a484e7295a90162a92d81b)): ?>
<?php $attributes = $__attributesOriginal6cced52613a484e7295a90162a92d81b; ?>
<?php unset($__attributesOriginal6cced52613a484e7295a90162a92d81b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6cced52613a484e7295a90162a92d81b)): ?>
<?php $component = $__componentOriginal6cced52613a484e7295a90162a92d81b; ?>
<?php unset($__componentOriginal6cced52613a484e7295a90162a92d81b); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$inFooter): ?>
            <div class="pl-6 flex items-center space-x-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="text-sm  text-main-page font-normal
                    hover:text-sky-600
                     transition-colors">Вход</a>
                    <a href="<?php echo e(route('register')); ?>" class="text-sm font-medium px-4 py-2
                    bg-sky-500 text-sky-100 rounded-md hover:bg-sky-600
                    transition-colors">Регистрация</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="text-sm font-medium hover:text-sky-600 transition-colors">Личный кабинет</a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="text-sm font-medium hover:text-sky-600 transition-colors">Выход</button>
                    </form>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="<?php echo e($inFooter ? 'lg:block' : 'lg:hidden'); ?>">

        <button @click="isOpen = !isOpen" class="p-2 rounded-md <?php echo e($inFooter ? 'text-sky-100
        hover:text-sky-200 hover:bg-sky-700' : 'text-sky-900 hover:text-sky-950 hover:bg-sky-100'); ?> focus:outline-none focus:ring-2 focus:ring-sky-500 transition-colors">

            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div x-show="isOpen"
             @click.away="isOpen = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform <?php echo e($inFooter ? 'translate-y-2' : '-translate-y-2'); ?>"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform <?php echo e($inFooter ? 'translate-y-2' : '-translate-y-2'); ?>"
             class="absolute <?php echo e($inFooter ? 'bottom-full mb-2' : 'top-full mt-2'); ?> right-0 w-64 bg-sky-100 rounded-lg shadow-xl border z-30"
             x-cloak>
            <div class="py-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal6cced52613a484e7295a90162a92d81b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6cced52613a484e7295a90162a92d81b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-item','data' => ['item' => $item,'isMobile' => true,'inFooter' => $inFooter]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item),'is-mobile' => true,'in-footer' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($inFooter)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6cced52613a484e7295a90162a92d81b)): ?>
<?php $attributes = $__attributesOriginal6cced52613a484e7295a90162a92d81b; ?>
<?php unset($__attributesOriginal6cced52613a484e7295a90162a92d81b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6cced52613a484e7295a90162a92d81b)): ?>
<?php $component = $__componentOriginal6cced52613a484e7295a90162a92d81b; ?>
<?php unset($__componentOriginal6cced52613a484e7295a90162a92d81b); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$inFooter): ?>
                    <div class="border-t border-sky-200 mt-2 pt-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                            <a href="<?php echo e(route('login')); ?>" class="block px-4 py-2 text-sm
                            text-sky-900
                            hover:bg-sky-100 transition-colors">Вход</a>
                            <a href="<?php echo e(route('register')); ?>" class="block px-4 py-2 text-sm text-sky-900  hover:bg-sky-100 transition-colors">Регистрация</a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('dashboard')); ?>" class="block px-4 py-2 text-sm text-sky-900  hover:bg-sky-100 transition-colors">Личный кабинет</a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-sky-900  hover:bg-sky-100 transition-colors">Выход</button>
                            </form>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\components\navigation.blade.php ENDPATH**/ ?>