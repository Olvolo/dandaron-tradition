@php
    $title = 'Фотогалерея Великой Ступы Дхамек';
@endphp

@section('content')
    <!-- Секция: Ступа Дхамек -->
    <div class="prose text-justify max-w-4xl mx-auto leading-relaxed space-y-6 mt-12 px-4 md:px-0">

        <p>
            Ступа Дхамек (Dhamekh Stupa) в Сарнатхе (штат Уттар-Прадеш, Индия) — один из величайших
            памятников раннего буддизма. Именно здесь, примерно в 528 году до н.э., Будда Шакьямуни
            после своего просветления впервые изложил Учение — наставление о <strong>Четырёх
                Благородных Истинах</strong> и <strong>Восьмеричном Пути</strong> — группе из пяти
            аскетов, ставших его первыми учениками. Это событие в буддийской традиции именуется
            «<strong>первым поворотом Колеса Дхармы</strong>» и считается рождением сангхи —
            буддийской общины.
        </p>

        <p>
            Нынешняя ступа, сохранившаяся до наших дней, была воздвигнута в V веке н.э. при
            императоре Кумарагупте I из династии Гуптов, хотя археологи обнаружили следы более
            древних сооружений, восходящих к эпохе императора Ашоки (III век до н.э.). Ступа Дхамек
            имеет высоту около 34 метров и диаметр основания — 28 метров. Её цилиндрическая форма,
            покрытая декоративной каменной кладкой с геометрическими и цветочными мотивами,
            отличается от типичных полусферических ступ, что подчёркивает её исключительное значение
            как места проповеди Дхармы.
        </p>

        <p>
            Сарнатх (древнее название — <em>Ришипатана Мригадаявана</em>, «Олений парк») является
            одним из <strong>Четырёх Священных Мест</strong>, посещаемых последователями Будды.
            Вместе с местом рождения (Лумбини), просветления (Бодх-Гая) и
            паринирваны (Кушинагар), Сарнатх завершает паломнический круг, символизирующий полный
            путь Будды.
        </p>

        <p class="text-base text-sky-700 italic text-center mt-4">
            Фотографии предоставлены Сергеем Топорковым
        </p>

        <!-- Переключатель режимов просмотра -->
        <div class="flex justify-center my-6">
            <div class="inline-flex rounded-lg shadow-sm border border-sky-200 overflow-hidden"
                 role="group">
                <button type="button"
                        id="gallery-grid-btn"
                        class="px-6 py-2 text-xs font-medium text-sky-900 bg-sky-100 hover:bg-sky-200 transition-colors"
                        onclick="switchGalleryView('grid')">
                    Сетка
                </button>
                <button type="button"
                        id="gallery-carousel-btn"
                        class="px-6 py-2 text-xs font-medium text-sky-900 bg-white hover:bg-sky-50 transition-colors border-l border-sky-200"
                        onclick="switchGalleryView('carousel')">
                    Карусель
                </button>
            </div>
        </div>

        <!-- Контейнер галереи -->
        <div id="photo-gallery" class="mt-6 min-h-[600px] pb-8"></div>

    </div>

    <script>
        const photos = [
            {
                src: '/images/additional_materials/photomaterials/dhamek/Dhamek_view.webp',
                alt: 'Ступа Дхамек вблизи'
            },
            {
                src: '/images/additional_materials/photomaterials/dhamek/Dhamek_viewside.webp',
                alt: 'Вид ступы издали'
            },
            {
                src: '/images/additional_materials/photomaterials/dhamek/general_plan.webp',
                alt: 'Когда-то здесь был комплекс зданий'
            },
            {
                src: '/images/additional_materials/photomaterials/dhamek/Panoram.webp',
                alt: 'Панорама комплекса Сарнатха'
            },
            {
                src: '/images/additional_materials/photomaterials/dhamek/Panoram_Dhamek.webp',
                alt: 'Панорамный вид ступы Дхамек'
            },
            {
                src: '/images/additional_materials/photomaterials/dhamek/stupa_centre.webp',
                alt: 'Её форма необычна'
            },
            {
                src: '/images/additional_materials/photomaterials/dhamek/stupa_tree.webp',
                alt: 'Под сенью дерева'
            }
        ];

        let currentIndex = 0;
        let currentView = 'grid';

        function renderGrid() {
            const html = photos.map(photo => `
            <figure class="rounded-xl shadow-sm bg-sky-50/50 overflow-hidden border border-sky-100">
                <img src="${photo.src}"
                     alt="${photo.alt}"
                     class="w-full h-auto object-contain"
                     style="max-height: 80vh;"
                     loading="lazy">
                <figcaption class="p-3 text-center text-base italic text-sky-800">${photo.alt}</figcaption>
            </figure>
        `).join('');

            document.getElementById('photo-gallery').innerHTML = `<div class="space-y-6">${html}</div>`;
        }

        function renderCarousel() {
            const photo = photos[currentIndex];
            const total = photos.length;

            document.getElementById('photo-gallery').innerHTML = `
            <div class="py-6 flex justify-center">
                <div class="max-w-3xl w-full bg-sky-50/50 border border-sky-100 rounded-xl p-4 md:p-6">
                    <img src="${photo.src}"
                         alt="${photo.alt}"
                         class="w-full h-auto mx-auto object-contain"
                         style="max-height: 80vh;"
                         loading="lazy">
                    <figcaption class="mt-3 text-sky-800 italic text-center text-base">${photo.alt}</figcaption>
                    <div class="mt-5 flex items-center justify-center space-x-3">
                        <button onclick="galleryPrev()"
                                class="w-10 h-10 flex items-center justify-center rounded-full bg-sky-100 text-sky-700 hover:bg-sky-200 transition-colors focus:outline-none focus:ring-2 focus:ring-sky-300"
                                aria-label="Предыдущее изображение">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <span class="px-3 py-1 bg-sky-100 text-sky-800 rounded-full text-sm font-medium">${currentIndex + 1} / ${total}</span>
                        <button onclick="galleryNext()"
                                class="w-10 h-10 flex items-center justify-center rounded-full bg-sky-100 text-sky-700 hover:bg-sky-200 transition-colors focus:outline-none focus:ring-2 focus:ring-sky-300"
                                aria-label="Следующее изображение">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `;
        }

        function switchGalleryView(mode) {
            currentView = mode;
            const gridBtn = document.getElementById('gallery-grid-btn');
            const carouselBtn = document.getElementById('gallery-carousel-btn');

            if (mode === 'grid') {
                renderGrid();
                gridBtn.classList.remove('bg-white');
                gridBtn.classList.add('bg-sky-100');
                carouselBtn.classList.remove('bg-sky-100');
                carouselBtn.classList.add('bg-white');
            } else {
                renderCarousel();
                carouselBtn.classList.remove('bg-white');
                carouselBtn.classList.add('bg-sky-100');
                gridBtn.classList.remove('bg-sky-100');
                gridBtn.classList.add('bg-white');
            }
        }

        function galleryNext() {
            currentIndex = (currentIndex + 1) % photos.length;
            if (currentView === 'carousel') renderCarousel();
        }

        function galleryPrev() {
            currentIndex = (currentIndex - 1 + photos.length) % photos.length;
            if (currentView === 'carousel') renderCarousel();
        }

        document.addEventListener('keydown', (e) => {
            if (currentView !== 'carousel') return;
            if (e.key === 'ArrowRight') galleryNext();
            if (e.key === 'ArrowLeft') galleryPrev();
        });

        document.addEventListener('DOMContentLoaded', () => {
            switchGalleryView('grid');
        });
    </script>


    <!-- Секция: Великая Ступа Боднатх -->
    <div class="prose text-justify max-w-4xl mx-auto leading-relaxed space-y-6 px-4 md:px-0 mt-12">

        <p class="text-lg leading-relaxed">
            Великая Ступа Боднатх (тиб. <em>Джарунхашор</em>) — одно из самых почитаемых мест
            буддийского паломничества за пределами Тибета. Расположенная в северо-восточной части
            долины Катманду, она возвышается над городской суетой, словно светящийся маяк духовного
            пробуждения.
        </p>

        <p class="text-sm text-sky-700 italic text-center mt-4">
            Благодарим Сергея Топоркова за предоставленные фотографии.
        </p>

        <!-- Переключатель режимов просмотра -->
        <div class="flex justify-center my-6">
            <div class="inline-flex rounded-lg shadow-sm border border-sky-200 overflow-hidden"
                 role="group">
                <button type="button"
                        id="gallery-grid-btn-2"
                        class="px-6 py-2 text-xs font-medium text-sky-900 bg-sky-100 hover:bg-sky-200 transition-colors"
                        onclick="switchGalleryView2('grid')">
                    Сетка
                </button>
                <button type="button"
                        id="gallery-carousel-btn-2"
                        class="px-6 py-2 text-xs font-medium text-sky-900 bg-white hover:bg-sky-50 transition-colors border-l border-sky-200"
                        onclick="switchGalleryView2('carousel')">
                    Карусель
                </button>
            </div>
        </div>

        <!-- Контейнер галереи -->
        <div id="photo-gallery-2" class="mt-6 min-h-[600px] pb-8"></div>

    </div>

    <script>
        const photos2 = [
            {
                src: '/images/origins/toporkov_photos/Bodnath_bird.webp',
                alt: 'Великая Ступа в дымке окружающей долины'
            },
            {
                src: '/images/origins/toporkov_photos/Bodnath_blue_sky.webp',
                alt: 'На фоне безоблачного неба Непала'
            },
            {
                src: '/images/origins/toporkov_photos/Bodnath_cloud_sky.webp',
                alt: 'Ступа и стихии неба и земли'
            },
            {
                src: '/images/origins/toporkov_photos/Bodnath_dark_blue_sky.webp',
                alt: 'Вижу и днём и ночью'
            },
            {
                src: '/images/origins/toporkov_photos/Bodnath_dark_blue_sky_wide.webp',
                alt: 'На фоне ночного неба'
            },
            {
                src: '/images/origins/toporkov_photos/Bodnath_eyes.webp',
                alt: 'Всевидящие глаза мудрости – символ всеведения Будды'
            },
            {
                src: '/images/origins/toporkov_photos/Bodnath_eyes_birds.webp',
                alt: 'Глаза мудрости наблюдают за миром, а птицы символизируют свободу духа'
            },
            {
                src: '/images/origins/toporkov_photos/Bodnath_eyes_cloudsky_birds.webp',
                alt: 'Прекрасна всегда'
            },
            {
                src: '/images/origins/toporkov_photos/Bodnath_eyes_fix.webp',
                alt: 'Красота – великая сила'
            },
            {
                src: '/images/origins/toporkov_photos/Bodnath_flags.webp',
                alt: 'Молитвенные флаги с мантрами развеваются на ветру, разнося благословение'
            },
            {src: '/images/origins/toporkov_photos/Bodnath_monks.webp', alt: 'Монахи у ступы'},
            {
                src: '/images/origins/toporkov_photos/Bodnath_night.webp',
                alt: 'Ночная иллюминация создаёт мистическую атмосферу вокруг ступы'
            },
            {src: '/images/origins/toporkov_photos/Bodnath_night_nlo.webp', alt: 'Гость в небе'},
            {
                src: '/images/origins/toporkov_photos/Bodnath_prayings.webp',
                alt: 'Паломники совершают подношения и молитвы у основания ступы'
            },
            {
                src: '/images/origins/toporkov_photos/Bodnath_strong_cloud_sky.webp',
                alt: 'Драматические облака создают впечатляющий контраст с белой ступой'
            },
            {
                src: '/images/origins/toporkov_photos/Bodnath_sun.webp',
                alt: 'Великая Ступа и солнышко'
            },
            {src: '/images/origins/toporkov_photos/eyes.webp', alt: 'Всевидящие глаза'}
        ];

        let currentIndex2 = 0;
        let currentView2 = 'grid';

        function renderGrid2() {
            const html = photos2.map(photo => `
            <figure class="rounded-xl shadow-sm bg-sky-50/30 overflow-hidden border border-sky-100/50">
                <img src="${photo.src}"
                     alt="${photo.alt}"
                     class="w-full h-auto object-contain"
                     style="max-height: 80vh;"
                     loading="lazy">
                <figcaption class="p-3 text-center text-sm italic text-sky-800">${photo.alt}</figcaption>
            </figure>
        `).join('');
            document.getElementById('photo-gallery-2').innerHTML = `<div class="space-y-6">${html}</div>`;
        }

        function renderCarousel2() {
            const photo = photos2[currentIndex2];
            const total = photos2.length;
            document.getElementById('photo-gallery-2').innerHTML = `
            <div class="py-6 flex justify-center">
                <div class="max-w-3xl w-full min-h-[600px] bg-white/85 backdrop-blur-[1px]
                            border border-sky-200/40 rounded-xl p-4 md:p-5 shadow-sm">
                    <img src="${photo.src}"
                         alt="${photo.alt}"
                         class="w-full h-auto mx-auto object-contain"
                         style="max-height: 65vh;"
                         loading="lazy">
                    <figcaption class="mt-3 text-sky-800 italic text-center text-base px-2">${photo.alt}</figcaption>
                    <div class="mt-4 flex items-center justify-center space-x-3">
                        <button onclick="galleryPrev2()"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-sky-100/80 text-sky-700 hover:bg-sky-200 transition-colors focus:outline-none"
                                aria-label="Предыдущее">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <span class="px-2.5 py-0.5 bg-sky-100/70 text-sky-800 rounded text-xs font-medium">${currentIndex2 + 1} / ${total}</span>
                        <button onclick="galleryNext2()"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-sky-100/80 text-sky-700 hover:bg-sky-200 transition-colors focus:outline-none"
                                aria-label="Следующее">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `;
        }

        function switchGalleryView2(mode) {
            currentView2 = mode;
            const gridBtn = document.getElementById('gallery-grid-btn-2');
            const carouselBtn = document.getElementById('gallery-carousel-btn-2');

            if (mode === 'grid') {
                renderGrid2();
                gridBtn.classList.remove('bg-white');
                gridBtn.classList.add('bg-sky-100');
                carouselBtn.classList.remove('bg-sky-100');
                carouselBtn.classList.add('bg-white');
            } else {
                renderCarousel2();
                carouselBtn.classList.remove('bg-white');
                carouselBtn.classList.add('bg-sky-100');
                gridBtn.classList.remove('bg-sky-100');
                gridBtn.classList.add('bg-white');
            }
        }

        function galleryNext2() {
            currentIndex2 = (currentIndex2 + 1) % photos2.length;
            if (currentView2 === 'carousel') renderCarousel2();
        }

        function galleryPrev2() {
            currentIndex2 = (currentIndex2 - 1 + photos2.length) % photos2.length;
            if (currentView2 === 'carousel') renderCarousel2();
        }

        // Обработчик клавиш для второй галереи
        document.addEventListener('keydown', (e) => {
            if (currentView2 !== 'carousel') return;
            if (e.key === 'ArrowRight') galleryNext2();
            if (e.key === 'ArrowLeft') galleryPrev2();
        });

        document.addEventListener('DOMContentLoaded', () => {
            if (document.getElementById('photo-gallery-2')) {
                switchGalleryView2('grid');
            }
        });
    </script>
@endsection
