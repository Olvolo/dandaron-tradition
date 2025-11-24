<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="bg-slate-100 text-slate-900">
<div class="flex">
    <aside class="w-64 bg-slate-800 text-white p-4 min-h-screen">
        <a href="<?php echo e(route('home')); ?>" class="flex items-center" wire:navigate>
            <img
                src="<?php echo e(asset('images/logo/logo.webp')); ?>"
                alt="Dandaron Tradition"
                class="h-10 w-auto invert brightness-0">
        </a>
        <nav class="flex flex-col space-y-2">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:bg-slate-700 rounded p-2">Главная</a>
            <a href="<?php echo e(route('admin.structure.index')); ?>" class="hover:bg-slate-700 rounded p-2">Структура сайта</a>
            <a href="<?php echo e(route('admin.articles.index')); ?>" class="hover:bg-slate-700 rounded p-2">Статьи</a>
            <a href="<?php echo e(route('admin.books.index')); ?>" class="hover:bg-slate-700 rounded p-2">Книги</a>
            <a href="<?php echo e(route('admin.authors.index')); ?>" class="hover:bg-slate-700 rounded p-2">Авторы</a>
            <a href="<?php echo e(route('admin.taxonomy.index')); ?>" class="hover:bg-slate-700 rounded p-2">Категории и Теги</a>
        </nav>
    </aside>

    <main class="w-full p-6">
        <?php echo e($slot); ?>

    </main>
</div>
<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views/layouts/admin.blade.php ENDPATH**/ ?>