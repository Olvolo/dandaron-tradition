<header class="bg-sky-200 border-b border-sky-300 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center h-16">

            
            <button
                @click.stop="mobileLeftSidebar = true"
                class="xl:hidden mr-3 p-2 rounded-md text-sky-900 hover:bg-sky-300 focus:outline-none"
                aria-label="Меню"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            
            <div class="flex items-center space-x-8">

                
                <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-2 flex-shrink-0">
                    <img src="<?php echo e(asset('images/logo/logo.webp')); ?>" alt="Логотип" class="h-10 w-auto">
                </a>

                
                <div class="hidden xl:block flex-1 min-w-0">
                    <form action="<?php echo e(route('search')); ?>" method="GET" class="relative max-w-md">
                        <input
                            type="text"
                            name="q"
                            value="<?php echo e(request('q')); ?>"
                            placeholder="Поиск..."
                            class="w-full pl-4 pr-10 py-2 border border-sky-300 rounded-lg
                                   focus:outline-none focus:ring-2 focus:ring-sky-400 text-sm text-sky-800"
                        >
                        <button type="submit"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-sky-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

            </div>

            
            <div class="flex items-center flex-shrink-0">

                
                <?php if (isset($component)) { $__componentOriginalb65c079ff851496e674658fc0096e480 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb65c079ff851496e674658fc0096e480 = $attributes; } ?>
<?php $component = App\View\Components\HeaderNavigation::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header-navigation'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\HeaderNavigation::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb65c079ff851496e674658fc0096e480)): ?>
<?php $attributes = $__attributesOriginalb65c079ff851496e674658fc0096e480; ?>
<?php unset($__attributesOriginalb65c079ff851496e674658fc0096e480); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb65c079ff851496e674658fc0096e480)): ?>
<?php $component = $__componentOriginalb65c079ff851496e674658fc0096e480; ?>
<?php unset($__componentOriginalb65c079ff851496e674658fc0096e480); ?>
<?php endif; ?>

                
                <button
                    @click.stop="mobileRightSidebar = true"
                    class="xl:hidden ml-3 p-2 rounded-md text-sky-900 hover:bg-sky-300 focus:outline-none"
                    aria-label="Врата"
                >
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 3h12M6 21h12M3 6h18M3 18h18M9 9h6v6H9z" />
                    </svg>
                </button>

            </div>

        </div>

        
        <div class="xl:hidden pb-1 border-t border-sky-300">
            <?php if (isset($component)) { $__componentOriginale48b4598ffc2f41a085f001458a956d1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale48b4598ffc2f41a085f001458a956d1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale48b4598ffc2f41a085f001458a956d1)): ?>
<?php $attributes = $__attributesOriginale48b4598ffc2f41a085f001458a956d1; ?>
<?php unset($__attributesOriginale48b4598ffc2f41a085f001458a956d1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale48b4598ffc2f41a085f001458a956d1)): ?>
<?php $component = $__componentOriginale48b4598ffc2f41a085f001458a956d1; ?>
<?php unset($__componentOriginale48b4598ffc2f41a085f001458a956d1); ?>
<?php endif; ?>
        </div>

    </div>
</header>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views/layouts/partials/header.blade.php ENDPATH**/ ?>