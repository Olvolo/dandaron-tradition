<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Placement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Throwable;

class PageController extends Controller
{
    /**
     * @param string|null $slug
     * @return View|RedirectResponse
     */

    public function show(string $slug = null): View|RedirectResponse
    {
        $searchSlug = $slug ?? '';
        $placement = Placement::where('full_slug', $searchSlug)->first();

        if (!$placement) {
            // Прямого совпадения нет — пробуем разобрать путь как
            // "{full_slug книги}/{slugs предков}/{slug главы}".
            $chapterResponse = $this->tryResolveChapter($searchSlug);

            if ($chapterResponse) {
                return $chapterResponse;
            }

            abort(404);
        }

        if ($placement->is_protected && !Auth::check()) {
            return redirect()->route('login');
        }

        $placement->load(['placementable', 'children' => function ($query) {
            $query->orderBy('order_column', 'asc');
        },
            'children.parent'
        ]);

        if ($placement->placementable) {
            $content = $placement->placementable;

            // Проверяем is_protected у самого контента (Article/Book)
            if (($content->hasAttribute('is_protected') || isset($content->is_protected))
                && $content->is_protected && !Auth::check()) {
                return redirect()->route('login');
            }

            $query = request()->input('q') ?? session('last_search_query');

            // Применяем подсветку, если есть поисковый запрос
            if ($query) {
                $content = $this->highlightContent($content, $query);
            }

            if ($content instanceof Article) {
                return view('pages.article', ['article' => $content, 'content' => $content]);
            }
            if ($content instanceof Book) {
                $content->load(['authors', 'chapters.childrenRecursive']);
                return view('pages.book', ['book' => $content, 'content' => $content]);
            }
        }

        if ($placement->children->isNotEmpty()) {
            $subSections = $placement->children()->orderBy('order_column', 'asc')->get();

            return view('pages.section', [
                'placement' => $placement,
                'subSections' => $subSections,
                'content' => $placement
            ]);
        }

        return view('pages.empty', ['placement' => $placement, 'content' => $placement]);
    }

    public function home()
    {
        // Получаем главную страницу (с пустым full_slug для главной)
        $homePlacement = Placement::where('full_slug', '')->first();

        $featured = Placement::where('show_on_main', true)
            ->with('placementable')
            ->orderBy('order_column', 'asc')
            ->limit(6)
            ->get();

        return view('home', [
            'featured' => $featured,
            'content' => $homePlacement  // Передаем Placement напрямую
        ]);
    }

    /**
     * Пытается разобрать путь как адрес главы вида
     * "{full_slug книги}/{slugs предков главы}/{slug главы}".
     *
     * Путь книги может занимать несколько первых сегментов (это full_slug
     * из дерева Placement), а после него идут slugs родительских глав
     * (0 и более) и в конце — slug самой главы. Поскольку slug главы
     * уникален в пределах книги, промежуточные сегменты для поиска не
     * обязательны — но мы всё равно проверяем их совпадение с реальной
     * цепочкой предков, чтобы отсечь случайные/поддельные URL.
     *
     * Возвращает готовый View, редирект на логин, либо null, если это не глава.
     */
    protected function tryResolveChapter(string $searchSlug): View|RedirectResponse|null
    {
        $segments = explode('/', trim($searchSlug, '/'));

        if (count($segments) < 2) {
            return null;
        }

        // Последний сегмент — всегда slug искомой главы.
        $chapterSlug = array_pop($segments);

        // Оставшиеся сегменты делятся на "путь книги" + "slugs предков главы".
        // Пробуем найти книгу, укорачивая путь с конца, пока не найдём
        // реальный Placement типа Book.
        $bookPlacement = null;
        $bookSegmentsCount = count($segments);

        while ($bookSegmentsCount > 0) {
            $candidatePath = implode('/', array_slice($segments, 0, $bookSegmentsCount));
            $candidate = Placement::where('full_slug', $candidatePath)->first();

            if ($candidate && $candidate->placementable instanceof Book) {
                $bookPlacement = $candidate;
                break;
            }

            $bookSegmentsCount--;
        }

        if (!$bookPlacement) {
            return null;
        }

        $book = $bookPlacement->placementable;
        $chapter = $book->chapters()->where('slug', $chapterSlug)->first();

        if (!$chapter) {
            return null;
        }

        // Сегменты между путём книги и slug главы — это ожидаемые slugs
        // предков. Сверяем их с реальной цепочкой, чтобы не открывать
        // главу по произвольному "похожему" пути.
        $expectedAncestorSlugs = array_slice($segments, $bookSegmentsCount);
        $actualAncestorSlugs = $chapter->getAncestors()->pluck('slug')->all();

        if ($expectedAncestorSlugs !== $actualAncestorSlugs) {
            return null;
        }

        if ($book->is_protected && !Auth::check()) {
            return redirect()->route('login');
        }

        $chapter->load('parent');

        $query = request()->input('q') ?? session('last_search_query');
        if ($query) {
            $chapter = $this->highlightContent($chapter, $query);
        }

        $breadcrumbs = [
            ['title' => 'Главная', 'url' => url('/')],
            ['title' => $book->title, 'url' => $book->getUrl()],
        ];

        foreach ($chapter->getAncestors() as $ancestor) {
            $breadcrumbs[] = ['title' => $ancestor->title, 'url' => $ancestor->getUrl()];
        }

        $breadcrumbs[] = ['title' => $chapter->title];

        return view('pages.chapter', [
            'chapter' => $chapter,
            'book' => $book,
            'content' => $chapter,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    protected function highlightContent($content, string $query)
    {
        if (empty($query)) {
            return $content;
        }

        try {
            // Получаем имя класса (строку)
            $modelClass = get_class($content);

            // Убеждаемся, что этот класс действительно существует и поддерживает Scout
            if (class_exists($modelClass) && method_exists($modelClass, 'search')) {

                // Выполняем поиск по текущей модели
                $results = $modelClass::search($query)->get();

                // Проверяем, есть ли совпадение именно для текущего ID
                $matched = $results->firstWhere('id', $content->id ?? null);

                if ($matched) {
                    $pattern = '/' . preg_quote($query, '/') . '/iu';

                    // Подсвечиваем совпадения в основных текстовых полях
                    foreach (['title', 'annotation', 'content_html'] as $field) {
                        if (!empty($content->$field)) {
                            $content->$field = preg_replace(
                                $pattern,
                                '<mark class="search-highlight">$0</mark>',
                                $content->$field
                            );
                        }
                    }
                }
            } else {
                logger()->warning("Model $modelClass не поддерживает Scout::search()");
            }
        } catch (Throwable $e) {
            logger()->error("Highlight failed for $modelClass: ".$e->getMessage());
        }

        return $content;
    }
}
