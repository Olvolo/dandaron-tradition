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
        x-data="tocComponent()"
        x-init="init()"
        class="prose prose-lg max-w-none"
    >
        <h1 class="text-center"><?php echo e($article->title); ?></h1>

        <div x-ref="content">
            <?php echo $article->fixed_content; ?>

        </div>

        <!-- Модальное оглавление (телепортируется в body, чтобы fixed работало корректно) -->
        <template x-if="toc.length > 0">
            <template x-teleport="body">
                <div>
                    <div x-show="tocOpen" x-cloak class="fixed inset-0 z-[9999] flex">
                        <div @click="close()" class="absolute inset-0 bg-black/50"></div>

                        <div class="relative flex flex-col max-w-xs w-full h-full bg-white">
                            <div class="p-6 border-b flex items-center justify-between">
                                <h3 class="text-xl font-semibold">Содержание</h3>
                                <button @click="close()" class="p-1 rounded-full hover:bg-gray-200 text-2xl leading-none">&times;</button>
                            </div>

                            <div class="p-6 overflow-y-auto flex-grow">
                                <ul class="space-y-2">
                                    <template x-for="item in toc" :key="item.id">
                                        <li :class="{ 'pl-4': item.level === 'h3', 'pl-8': item.level === 'h4' }">
                                            <a
                                                :href="'#' + item.id"
                                                class="no-underline hover:text-amber-600 block py-1"
                                                @click.prevent="goTo(item.id)"
                                                x-text="item.text"
                                            ></a>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </template>
    </div>

    <script>
        function tocComponent() {
            return {
                toc: [],
                tocOpen: false,
                openHandler: null,

                init() {
                    // Подпишемся на событие от layout — безопасно и однократно
                    this.openHandler = () => { this.tocOpen = true; };
                    window.addEventListener('open-toc', this.openHandler);

                    // Построим оглавление — с защитой на случай, если контент подгружается
                    const tryBuild = () => {
                        const content = this.$refs.content;
                        if (!content) {
                            setTimeout(tryBuild, 50);
                            return;
                        }

                        // Не добавляем пункты повторно при повторном вызове init
                        if (this.toc.length > 0) return;

                        const headings = content.querySelectorAll('h2, h3, h4');
                        headings.forEach((heading, i) => {
                            // сохраняем существующий id или генерируем понятный
                            const existingId = heading.id;
                            const id = existingId || ('toc-' + i + '-' + heading.textContent.trim().toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]+/g, ''));

                            if (!existingId) heading.id = id;
                            heading.classList.add('scroll-mt-20');

                            // убираем возможные вспомогательные элементы при извлечении текста
                            const clone = heading.cloneNode(true);
                            if (clone.querySelectorAll) {
                                clone.querySelectorAll('.citation-mark').forEach(mark => mark.remove());
                            }
                            const cleanText = clone.textContent.trim();

                            this.toc.push({
                                id: id,
                                text: cleanText || heading.textContent.trim(),
                                level: heading.tagName.toLowerCase()
                            });
                        });
                    };

                    tryBuild();

                    // (опционально) очистка слушателя при удалении компонента
                    // Если Alpine поддерживает жизненный цикл, можно убрать слушатель; иначе это нормально оставлять.
                    // window.addEventListener('beforeunload', () => window.removeEventListener('open-toc', this.openHandler));
                },

                goTo(id) {
                    const el = document.getElementById(id);
                    if (el) el.scrollIntoView({ behavior: 'smooth' });
                    this.tocOpen = false;
                },

                close() {
                    this.tocOpen = false;
                }
            };
        }
    </script>
    <script>
        function tocComponent() {
            return {
                toc: [],
                tocOpen: false,
                openHandler: null,

                init() {
                    // Подпишемся на событие от layout
                    this.openHandler = () => { this.tocOpen = true; };
                    window.addEventListener('open-toc', this.openHandler);

                    // Построим оглавление
                    const tryBuild = () => {
                        const content = this.$refs.content;
                        if (!content) {
                            setTimeout(tryBuild, 50);
                            return;
                        }

                        if (this.toc.length > 0) return;

                        const headings = content.querySelectorAll('h2, h3, h4');
                        headings.forEach((heading, i) => {
                            const existingId = heading.id;
                            const id = existingId || ('toc-' + i + '-' + heading.textContent.trim().toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]+/g, ''));

                            if (!existingId) heading.id = id;
                            heading.classList.add('scroll-mt-20');

                            const clone = heading.cloneNode(true);
                            if (clone.querySelectorAll) {
                                clone.querySelectorAll('.citation-mark').forEach(mark => mark.remove());
                            }
                            const cleanText = clone.textContent.trim();

                            this.toc.push({
                                id: id,
                                text: cleanText || heading.textContent.trim(),
                                level: heading.tagName.toLowerCase()
                            });
                        });

                        // Уведомляем layout, что оглавление готово
                        if (this.toc.length > 0) {
                            window.dispatchEvent(new CustomEvent('toc-ready'));
                        }
                    };

                    tryBuild();
                },

                goTo(id) {
                    const el = document.getElementById(id);
                    if (el) el.scrollIntoView({ behavior: 'smooth' });
                    this.tocOpen = false;
                },

                close() {
                    this.tocOpen = false;
                }
            };
        }
    </script>
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
<?php /**PATH C:\laragon\www\dandaron-tradition\resources\views\pages\article.blade.php ENDPATH**/ ?>