<x-layout :content="$article">
    @section('title', $article->title)
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

        <h1 class="text-center">{{ $article->title }}</h1>

        <div x-ref="content">
            {!! $article->fixed_content !!}
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
</x-layout>
