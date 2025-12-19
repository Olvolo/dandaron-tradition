<form action="<?php echo e(route('search')); ?>" method="GET" <?php echo e($attributes->merge(['class' => 'relative'])); ?>>
    <div class="relative">
        <input
            type="text"
            name="q"
            value="<?php echo e(request('q')); ?>"
            placeholder="Поиск..."
            class="w-full px-2 mx-2 py-2 border border-sky-400 rounded-lg focus:outline-none
            focus:ring-2 focus:ring-sky-600 focus:border-sky-600 transition-colors"
        >
        <button type="submit"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-sky-600 text-sky-100
                px-2 py-2 rounded hover:bg-sky-700 transition-colors text-sm">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>
    </div>
</form>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\components\search-form.blade.php ENDPATH**/ ?>