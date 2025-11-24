<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['content' => $article]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['content' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($article)]); ?>
    <?php $__env->startSection('title', $article->title); ?>
    <div
        x-data="{ toc: [], tocOpen: false }"
        x-init="
            let content = $refs.content;
            let headings = content.querySelectorAll('h2, h3, h4');
            headings.forEach((heading, index) => {
                // ИСПРАВЛЕНИЕ: Сохраняем существующий id если он есть, иначе создаем новый
                let existingId = heading.id;
                let id = existingId || ('toc-' + index + '-' + heading.textContent.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]+/g, ''));

                // Устанавливаем id только если его не было
                if (!existingId) {
                    heading.id = id;
                }

                heading.classList.add('scroll-mt-20');

                // Клонируем заголовок, убираем цитаты, получаем чистый текст
                let clone = heading.cloneNode(true);
                clone.querySelectorAll('.citation-mark').forEach(mark => mark.remove());
                let cleanText = clone.textContent.trim();

                toc.push({
                    id: heading.id, // Используем реальный id заголовка
                    text: cleanText,
                    level: heading.tagName.toLowerCase()
                });
            });
        "
        class="prose prose-lg max-w-none">

        <h1 class="text-center"><?php echo e($article->title); ?></h1>

        <div x-ref="content">
            <?php echo $article->fixed_content; ?>

        </div>

                <template x-if="toc.length > 0">
                    <div>
                        <button @click="tocOpen = true" class="fixed bottom-5 left-5 z-40 px-4 py-2 bg-sky-600 text-white rounded-full shadow-lg hover:bg-sky-700">
                            Содержание
                        </button>
                        <template x-teleport="body">
                            <div x-show="tocOpen" x-cloak class="fixed inset-0 z-50 flex">
                                <div @click="tocOpen = false" class="absolute inset-0 bg-black/50"></div>
                                <div class="relative flex flex-col max-w-xs w-full h-full bg-white">
                                    <div class="flex-shrink-0 p-6 border-b">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-xl font-semibold">Содержание</h3>
                                            <button @click="tocOpen = false" class="p-1 rounded-full hover:bg-gray-200 text-2xl leading-none">&times;</button>
                                        </div>
                                    </div>
                                    <div class="flex-grow p-6 overflow-y-auto">
                                        <ul class="space-y-2">
                                            <template x-for="item in toc" :key="item.id">
                                                <li :class="{ 'pl-4': item.level === 'h3', 'pl-8': item.level === 'h4' }">
                                                    <a :href="'#' + item.id"
                                                       @click.prevent="document.querySelector('#' + item.id).scrollIntoView({ behavior: 'smooth' }); tocOpen = false;"
                                                       class="no-underline hover:text-amber-600 block py-1"
                                                       x-text="item.text">
                                                    </a>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

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
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views/pages/article.blade.php ENDPATH**/ ?>