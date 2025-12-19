<?php?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['content' => null]));

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

foreach (array_filter((['content' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

    <!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo e($title ?? 'Dandaron Tradition'); ?></title>

    <meta name="description"
          content="<?php echo e($content->annotation ?? 'Dandaron Tradition - онлайн-архив статей и книг, посвящённый работам ряда авторов.'); ?>">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($content->custom_styles)): ?>
        <style><?php echo $content->custom_styles; ?></style>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</head>

<body
    x-data="{
        atTop: true,
        mobileLeftSidebar: false,
        mobileRightSidebar: false,
        tocAvailable: false,
        tocOpen: false
    }"
    @scroll.window="atTop = (window.scrollY < 100)"
    @toc-ready.window="tocAvailable = true"
    class="antialiased font-sans bg-sky-200 text-sky-950 flex flex-col min-h-screen"
    <?php if(!empty($content->background_image_url)): ?>
        style="background-image: url('<?php echo e(asset($content->background_image_url)); ?>');
               background-size: cover;
               background-position: center;
               background-attachment: fixed;"
    <?php endif; ?>
>

<?php echo $__env->make('layouts.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="flex-grow max-w-screen-3xl mx-auto px-4 md:px-6 pt-24 pb-6">
    <div class="grid grid-cols-1 xl:grid-cols-[minmax(240px,1fr)_minmax(0,2fr)_minmax(240px,1fr)] gap-4 md:gap-6">

        <aside class="hidden xl:block">
            <div class="sticky top-14 max-h-[calc(100vh-4rem-1.5rem)] overflow-y-auto pr-2">
                <div class="bg-gradient-to-br from-sky-50/90 via-white/80 to-sky-50/90
            backdrop-blur-xl border border-sky-200/60
            rounded-2xl shadow-lg shadow-sky-200/30
            p-4 relative overflow-hidden">

                    
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-sky-200/20 to-transparent rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-sky-300/10 to-transparent rounded-full blur-xl"></div>

                    
                    <div class="relative pt-8">
                        <?php if (isset($component)) { $__componentOriginal73510ed79b0513caa61757fa57cf31a7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73510ed79b0513caa61757fa57cf31a7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tree-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tree-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73510ed79b0513caa61757fa57cf31a7)): ?>
<?php $attributes = $__attributesOriginal73510ed79b0513caa61757fa57cf31a7; ?>
<?php unset($__attributesOriginal73510ed79b0513caa61757fa57cf31a7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73510ed79b0513caa61757fa57cf31a7)): ?>
<?php $component = $__componentOriginal73510ed79b0513caa61757fa57cf31a7; ?>
<?php unset($__componentOriginal73510ed79b0513caa61757fa57cf31a7); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>
        </aside>

        
        <main>
            <div class="bg-sky-50/10 backdrop-blur-sm rounded-2xl p-4 border border-sky-300/20">
                <?php echo e($slot); ?>

            </div>
        </main>
        
        <aside class="hidden xl:block">
            <div class="sticky top-14 max-h-[calc(100vh-4rem-1.5rem)] overflow-y-auto pl-2">
                <div class="bg-sky-50/10 backdrop-blur-sm rounded-2xl p-4 border border-sky-200/30">

                    
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-sky-200/20 to-transparent rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-sky-300/10 to-transparent rounded-full blur-xl"></div>

                    
                    <div class="flex justify-center">
                        <figure class="rounded-lg shadow-sm w-full max-w-none">
                            <img
                                src="<?php echo e(asset('images/authors/dandaron_dharmaraja_right_sidebar.webp')); ?>"
                                alt="Дандарон Дхармараджа"
                                class="rounded-lg w-full h-auto object-contain"
                            >
                        </figure>
                    </div>
                </div>
            </div>
        </aside>

    </div>
</div>

<button
    x-show="tocAvailable"
    @click="window.dispatchEvent(new CustomEvent('open-toc'))"
    x-transition
    class="fixed bottom-5 left-5 z-40 px-4 py-2 bg-sky-600 text-white rounded-full shadow-lg hover:bg-sky-700">
    Содержание
</button>
<?php echo $__env->make('layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<button x-show="!atTop"
        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        x-transition
        class="fixed bottom-5 right-5 z-40 p-3 bg-sky-600 text-sky-100 rounded-full shadow-lg hover:bg-slate-700 focus:outline-none"
        aria-label="Прокрутить наверх">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 15l7-7 7 7"/>
    </svg>
</button>


<div
    x-show="mobileLeftSidebar"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click.self="mobileLeftSidebar = false"
    @keydown.escape.window="mobileLeftSidebar = false"
    class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm xl:hidden"
    style="display: none;"
>
    <div
        x-show="mobileLeftSidebar"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="absolute left-0 top-0 h-full w-72 bg-sky-50 shadow-xl p-4 overflow-y-auto"
    >
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-sky-900">Карта сайта</h3>
            <button
                @click="mobileLeftSidebar = false"
                class="p-2 hover:bg-sky-200 rounded-md transition-colors"
                aria-label="Закрыть меню"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <?php if (isset($component)) { $__componentOriginal73510ed79b0513caa61757fa57cf31a7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73510ed79b0513caa61757fa57cf31a7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tree-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tree-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73510ed79b0513caa61757fa57cf31a7)): ?>
<?php $attributes = $__attributesOriginal73510ed79b0513caa61757fa57cf31a7; ?>
<?php unset($__attributesOriginal73510ed79b0513caa61757fa57cf31a7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73510ed79b0513caa61757fa57cf31a7)): ?>
<?php $component = $__componentOriginal73510ed79b0513caa61757fa57cf31a7; ?>
<?php unset($__componentOriginal73510ed79b0513caa61757fa57cf31a7); ?>
<?php endif; ?>
    </div>
</div>


<div
    x-show="mobileRightSidebar"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click.self="mobileRightSidebar = false"
    @keydown.escape.window="mobileRightSidebar = false"
    class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm xl:hidden"
    style="display: none;"
>
    <div
        x-show="mobileRightSidebar"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="absolute right-0 top-0 h-full w-72 bg-sky-50 shadow-xl p-4 overflow-y-auto"
    >
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-sky-900">Врата</h3>
            <button
                @click="mobileRightSidebar = false"
                class="p-2 hover:bg-sky-200 rounded-md transition-colors"
                aria-label="Закрыть панель"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
            <a href="<?php echo e(route('login')); ?>" class="block py-2 text-sky-900 hover:bg-sky-200 rounded px-2 transition-colors">Вход</a>
            <a href="<?php echo e(route('register')); ?>" class="block py-2 text-sky-900 hover:bg-sky-200 rounded px-2 transition-colors">Регистрация</a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('dashboard')); ?>" class="block py-2 text-sky-900 hover:bg-sky-200 rounded px-2 transition-colors">Личный кабинет</a>
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-2">
                <?php echo csrf_field(); ?>
                <button class="w-full text-left py-2 px-2 text-sky-900 hover:bg-sky-200 rounded transition-colors">Выход</button>
            </form>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>

</body>
</html>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\components\layout.blade.php ENDPATH**/ ?>