<li class="text-lg">
    <a href="#chapter-<?php echo e($chapter->slug); ?>"
           @click.prevent="document.querySelector('#chapter-<?php echo e($chapter->slug); ?>').scrollIntoView
           ({ behavior: 'smooth' }); tocOpen = false;"
       class="block hover:text-amber-600">
        <?php echo e($chapter->title); ?>

    </a>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($chapter->children->isNotEmpty()): ?>
        <ul class="pl-4 mt-1 space-y-1">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $chapter->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('pages.partials.toc-item', ['chapter' => $child], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </ul>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</li>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views/pages/partials/toc-item.blade.php ENDPATH**/ ?>