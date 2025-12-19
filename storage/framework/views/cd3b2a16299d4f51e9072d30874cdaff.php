<?php use App\Models\Placement; ?>
<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Структура Сайта</h1>
        <button wire:click="create()"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Добавить корневой элемент
        </button>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('message')): ?>
        <div
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
            role="alert">
            <span class="block sm:inline"><?php echo e(session('message')); ?></span>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="bg-white shadow-md rounded-lg p-6">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($placements->isEmpty()): ?>
            <p class="text-center text-sky-600">Структура сайта пока пуста.</p>
        <?php else: ?>
            <ul class="space-y-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $placements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $placement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.structure.placement-item', ['placement' => $placement]);

$key = 'placement-'.$placement->id;

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3863247113-0', 'placement-'.$placement->id);

$__html = app('livewire')->mount($__name, $__params, $key);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </ul>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isModalOpen): ?>
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">
                    <?php echo e($placement_id ? 'Редактировать элемент' : 'Создать элемент'); ?>

                </h2>

                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Левая колонка -->
                        <div>
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-sky-800">Название</label>
                                <input
                                    type="text"
                                    id="title"
                                    wire:model.defer="title"
                                    class="mt-1 block w-full border-sky-400 rounded-md shadow-sm"
                                >
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="slug"
                                           class="block text-sm font-medium text-sky-800">Slug
                                        (URL)</label>
                                    <input
                                        type="text"
                                        id="slug"
                                        wire:model.defer="slug"
                                        class="mt-1 block w-full border-sky-400 rounded-md shadow-sm"
                                        placeholder="Авто"
                                    >
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div>
                                    <label for="order_column"
                                           class="block text-sm font-medium text-sky-800">Порядок</label>
                                    <input
                                        type="number"
                                        id="order_column"
                                        wire:model.defer="order_column"
                                        class="mt-1 block w-full border-sky-400 rounded-md shadow-sm"
                                        placeholder="0"
                                    >
                                    <p class="text-xs text-sky-600 mt-1">Элементы с меньшим номером
                                        отображаются первыми.</p>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['order_column'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="mb-4">
                                <label for="parent_id"
                                       class="block text-sm font-medium text-sky-800">Родительский
                                    элемент</label>
                                <select id="parent_id" wire:model.defer="parent_id"
                                        class="mt-1 block w-full border-sky-400 rounded-md shadow-sm">
                                    <option value="">-- Нет (Корневой элемент) --</option>
                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = Placement::whereNull('parent_id')->orderBy('order_column')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rootPlacement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo $__env->make('livewire.admin.structure.placement-option', ['placement' => $rootPlacement, 'level' => 0], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>

                            <!-- Чекбоксы -->
                            <div class="flex flex-wrap gap-6 mb-4">
                                <div class="flex items-center">
                                    <input
                                        id="show_in_menu"
                                        wire:model.defer="show_in_menu"
                                        type="checkbox"
                                        class="h-4 w-4 text-indigo-600 border-sky-400 rounded"
                                    >
                                    <label for="show_in_menu"
                                           class="ml-2 block text-sm text-sky-950">
                                        Показывать в меню
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        id="show_on_main"
                                        wire:model.defer="show_on_main"
                                        type="checkbox"
                                        class="h-4 w-4 text-indigo-600 border-sky-400 rounded"
                                    >
                                    <label for="show_on_main"
                                           class="ml-2 block text-sm text-sky-950">
                                        Показывать на главной
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        id="is_protected"
                                        wire:model.defer="is_protected"
                                        type="checkbox"
                                        class="h-4 w-4 text-indigo-600 border-sky-400 rounded"
                                    >
                                    <label for="is_protected"
                                           class="ml-2 block text-sm text-sky-950">
                                        Защищено (только для вошедших)
                                    </label>
                                </div>
                            </div>

                            <!-- Поля для фона и стилей -->
                            <div class="space-y-4">
                                <div>
                                    <label for="background_image_url"
                                           class="block text-sm font-medium text-sky-800">
                                        URL фонового изображения
                                    </label>
                                    <input
                                        type="text"
                                        id="background_image_url"
                                        wire:model.defer="background_image_url"
                                        class="mt-1 block w-full border-sky-400 rounded-md shadow-sm"
                                    >
                                </div>

                                <div>
                                    <label for="custom_styles"
                                           class="block text-sm font-medium text-sky-800">
                                        Кастомные CSS-стили
                                    </label>
                                    <textarea
                                        id="custom_styles"
                                        wire:model.defer="custom_styles"
                                        rows="5"
                                        class="mt-1 block w-full border-sky-400 rounded-md shadow-sm font-mono"
                                    ></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Правая колонка -->
                        <div class="border-l pl-6">
                            <h3 class="font-semibold text-sky-900">Привязать контент</h3>
                            <p class="text-sm text-sky-600 mb-4">Выберите либо статью, либо
                                книгу.</p>

                            <div class="mb-4">
                                <label for="link_article"
                                       class="block text-sm font-medium text-sky-800">Статья</label>
                                <select
                                    id="link_article"
                                    wire:model="article_link_id"
                                    class="mt-1 block w-full border-sky-400 rounded-md shadow-sm"
                                >
                                    <option value="">— Не выбрано —</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($article->id); ?>"><?php echo e($article->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="link_book"
                                       class="block text-sm font-medium text-sky-800">Книга</label>
                                <select
                                    id="link_book"
                                    wire:model="book_link_id"
                                    class="mt-1 block w-full border-sky-400 rounded-md shadow-sm"
                                >
                                    <option value="">— Не выбрано —</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($book->id); ?>"><?php echo e($book->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="flex justify-end space-x-4 mt-6 pt-4 border-t">
                    <button
                        wire:click="closeModal()"
                        class="px-4 py-2 bg-sky-400 rounded-md hover:bg-sky-500"
                    >
                        Отмена
                    </button>
                    <button
                        wire:click.prevent="store()"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                    >
                        Сохранить
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\livewire\admin\structure\manage-placements.blade.php ENDPATH**/ ?>