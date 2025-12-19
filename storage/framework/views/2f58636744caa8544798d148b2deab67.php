<div x-data="{ tocOpen: false }">
    
    <button @click="tocOpen = true"
            class="fixed bottom-5 left-5 z-40 px-4 py-2 bg-sky-600 text-white rounded-full shadow-lg hover:bg-sky-700">
        Оглавление
    </button>

    
    <template x-teleport="body">
        <div x-show="tocOpen" x-cloak class="fixed inset-0 z-50 flex">
            <div @click="tocOpen = false" class="absolute inset-0 bg-black/50"></div>
            <div class="relative flex flex-col max-w-xs w-full h-full bg-white">
                <div class="flex-shrink-0 p-6 border-b">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold">Оглавление</h3>
                        <button @click="tocOpen = false" class="p-1 rounded-full hover:bg-sky-300">&times;</button>
                    </div>
                </div>
                <div class="flex-grow p-6 overflow-y-auto">
                    <ul class="space-y-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $book->chapters->whereNull('parent_id')->sortBy('order_column'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('pages.partials.toc-item', ['chapter' => $chapter], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </template>
</div>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\components\book-toc.blade.php ENDPATH**/ ?>