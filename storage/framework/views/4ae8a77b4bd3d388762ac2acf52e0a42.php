<header class="fixed top-0 left-0 right-0 bg-sky-400 border-b border-sky-300 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-12">

            
            <div class="flex items-center">
                <button
                    @click.stop="mobileLeftSidebar = true"
                    class="mr-2 p-1.5 rounded-md text-sky-900 hover:bg-sky-300 focus:outline-none xl:hidden"
                    aria-label="Карта сайта">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-2">
                    <img src="<?php echo e(asset('images/logo/logo.webp')); ?>" alt="Логотип" class="h-8 w-auto">
                </a>
            </div>

            
            <div class="flex-1 max-w-2xl mx-2 xl:mx-4">
                <form action="<?php echo e(route('search')); ?>" method="GET" class="relative">
                    <input
                        type="text"
                        name="q"
                        value="<?php echo e(request('q')); ?>"
                        placeholder="Поиск..."
                        class="w-full pl-4 pr-10 py-1.5 text-sm rounded-lg border border-sky-300
                               bg-white/80 focus:outline-none focus:ring-2 focus:ring-sky-400 text-sky-800"
                    >
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-sky-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            
            <div class="flex items-center space-x-2">

                
                <div class="hidden xl:flex items-center space-x-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="text-sm text-sky-800 hover:text-sky-600 transition-colors">
                            Вход
                        </a>
                        <a href="<?php echo e(route('register')); ?>" class="text-sm font-medium px-3 py-1 bg-sky-500 text-sky-50 rounded-md hover:bg-sky-600 transition-colors">
                            Регистрация
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="text-sm text-sky-800 hover:text-sky-600 transition-colors">
                            Личный кабинет
                        </a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-sm text-sky-800 hover:text-sky-600 transition-colors">
                                Выход
                            </button>
                        </form>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <button
                    @click.stop="mobileRightSidebar = true"
                    class="p-1.5 rounded-md text-sky-900 hover:bg-sky-300 focus:outline-none xl:hidden"
                    aria-label="Врата">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 3h12M6 21h12M3 6h18M3 18h18M9 9h6v6H9z" />
                    </svg>
                </button>

            </div>

        </div>
    </div>
</header>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views/layouts/partials/header.blade.php ENDPATH**/ ?>