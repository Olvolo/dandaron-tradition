<x-layout :content="$article" :title="$article->title">

    @push('schema')
    <script type="application/ld+json">
    @php
        $authorData = $article->authors->isNotEmpty()
            ? $article->authors->map(fn($a) => ['@type' => 'Person', 'name' => $a->name])->toArray()
            : [['@type' => 'Organization', 'name' => 'Dandaron Tradition']];

        $schema = [
            "@@context" => "https://schema.org",
            "@type" => "Article",
            "headline" => $article->title,
            "description" => $article->getSeoDescription(),
            "datePublished" => $article->created_at->toIso8601String(),
            "dateModified" => $article->updated_at->toIso8601String(),
            "url" => $article->getUrl(),
            "author" => $authorData,
            "publisher" => [
                "@type" => "Organization",
                "name" => "Dandaron Tradition",
                "url" => url('/')
            ],
            "mainEntityOfPage" => [
                "@type" => "WebPage",
                "@id" => $article->getUrl()
            ]
        ];
    @endphp
    {!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
    @endpush

    <div x-data="tocComponent()" x-init="init()" class="prose prose-lg max-w-none">

        <x-breadcrumbs :placement="$article->placement" />

        <h1 class="text-center">{{ $article->title }}</h1>

        <div x-ref="content">
            {!! $article->fixed_content !!}
        </div>

        <template x-if="toc.length > 0">
            <template x-teleport="body">
                <div x-show="tocOpen" x-cloak class="fixed inset-0 z-[9999] flex">
                    <div @click="close()" class="absolute inset-0 bg-black/50 transition-opacity"></div>
                    <div class="relative flex flex-col max-w-xs w-full h-full bg-white shadow-2xl">
                        <div class="p-6 border-b flex items-center justify-between">
                            <h3 class="text-xl font-semibold">Содержание</h3>
                            <button @click="close()" class="p-1 rounded-full hover:bg-gray-200 transition-colors text-2xl leading-none">&times;</button>
                        </div>
                        <div class="p-6 overflow-y-auto flex-grow">
                            <nav aria-label="Оглавление статьи">
                                <ul class="space-y-2">
                                    <template x-for="item in toc" :key="item.id">
                                        <li :style="'padding-left: ' + (item.indent * 1) + 'rem'">
                                            <a :href="'#' + item.id" class="flex items-start gap-3 no-underline hover:text-amber-600 transition-colors py-1 group" @click.prevent="goTo(item.id)">
                                                <span class="flex-shrink-0 mt-2">
                                                    <template x-if="item.level === 'h2'"><span class="inline-block w-3 h-3 rounded-full bg-sky-600 group-hover:bg-amber-600"></span></template>
                                                    <template x-if="item.level === 'h3'"><span class="inline-block w-2.5 h-2.5 rounded-full bg-sky-500 group-hover:bg-amber-500"></span></template>
                                                    <template x-if="['h4', 'h5', 'h6'].includes(item.level)"><span class="inline-block w-2 h-2 rounded-full bg-sky-400 group-hover:bg-amber-400"></span></template>
                                                </span>
                                                <span class="flex-1" x-text="item.text"></span>
                                            </a>
                                        </li>
                                    </template>
                                </ul>
                            </nav>
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
                    // Подписка на событие открытия оглавления
                    this.openHandler = () => { this.tocOpen = true; };
                    window.addEventListener('open-toc', this.openHandler);

                    // Построение оглавления
                    this.buildToc();

                    // Закрытие по Escape
                    this.escapeHandler = (e) => {
                        if (e.key === 'Escape' && this.tocOpen) {
                            this.close();
                        }
                    };
                    document.addEventListener('keydown', this.escapeHandler);
                },

                buildToc() {
                    const tryBuild = () => {
                        const content = this.$refs.content;
                        if (!content) {
                            setTimeout(tryBuild, 50);
                            return;
                        }

                        // Защита от повторного построения
                        if (this.toc.length > 0) return;

                        const headings = content.querySelectorAll('h2, h3, h4, h5, h6');

                        headings.forEach((heading, i) => {
                            const tag = heading.tagName.toLowerCase();

                            // Генерация или использование существующего ID
                            const existingId = heading.id;
                            const generatedId = this.generateId(heading.textContent, i);
                            const id = existingId || generatedId;

                            if (!existingId) {
                                heading.id = id;
                            }

                            // Добавление класса для корректной прокрутки (с учетом фиксированного header)
                            heading.classList.add('scroll-mt-20');

                            // Извлечение чистого текста без служебных элементов
                            const cleanText = this.extractCleanText(heading);

                            // Определение уровня вложенности для отступов
                            const indent = this.getIndentLevel(tag);

                            this.toc.push({
                                id: id,
                                text: cleanText,
                                level: tag,
                                indent: indent
                            });
                        });

                        // Уведомление о готовности оглавления
                        if (this.toc.length > 0) {
                            window.dispatchEvent(new CustomEvent('toc-ready', {
                                detail: { count: this.toc.length }
                            }));
                        }
                    };

                    tryBuild();
                },

                generateId(text, index) {
                    const cleaned = text
                        .trim()
                        .toLowerCase()
                        .replace(/\s+/g, '-')
                        .replace(/[^\w\u0400-\u04FF-]+/g, '') // Поддержка кириллицы
                        .substring(0, 50); // Ограничение длины

                    return `toc-${index}-${cleaned}`;
                },

                extractCleanText(heading) {
                    const clone = heading.cloneNode(true);

                    // Удаление служебных элементов (например, маркеров цитат)
                    const elementsToRemove = clone.querySelectorAll('.citation-mark, .anchor-link, .header-link');
                    elementsToRemove.forEach(el => el.remove());

                    return clone.textContent.trim() || heading.textContent.trim();
                },

                getIndentLevel(tag) {
                    const levels = {
                        'h2': 0,
                        'h3': 1,
                        'h4': 2,
                        'h5': 3,
                        'h6': 4
                    };
                    return levels[tag] || 0;
                },

                goTo(id) {
                    const el = document.getElementById(id);
                    if (el) {
                        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        this.close();

                        // Фокус на элементе для доступности
                        setTimeout(() => {
                            el.tabIndex = -1;
                            el.focus();
                        }, 500);
                    }
                },

                close() {
                    this.tocOpen = false;
                },

                destroy() {
                    // Очистка слушателей при удалении компонента
                    if (this.openHandler) {
                        window.removeEventListener('open-toc', this.openHandler);
                    }
                    if (this.escapeHandler) {
                        document.removeEventListener('keydown', this.escapeHandler);
                    }
                }
            };
        }
    </script>
</x-layout>
