<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
use App\Models\Placement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class PageController extends Controller
{
    public function show(?string $slug = null): View|RedirectResponse
    {
        $searchSlug = $slug ?? '';

        $placement = Placement::where('full_slug', $searchSlug)->first();

        if (!$placement) {
            // Пробуем разобрать путь как адрес главы книги.
            $chapterResponse = $this->tryResolveChapter($searchSlug);

            if ($chapterResponse) {
                return $chapterResponse;
            }

            abort(404);
        }

        if ($placement->is_protected && !Auth::check()) {
            return redirect()->route('login');
        }

        $placement->load([
            'placementable',
            'children' => function ($query) {
                $query->orderBy('order_column', 'asc');
            },
            'children.parent',
        ]);

        if ($placement->placementable) {
            $content = $placement->placementable;

            // Проверяем защиту самого материала.
            if ($content->getAttribute('is_protected') && !Auth::check()) {
                return redirect()->route('login');
            }

            $query = request()->input('q') ?? session('last_search_query');

            if ($query) {
                $content = $this->highlightContent($content, $query);
            }

            if ($content instanceof Article) {
                return view('pages.article', [
                    'article' => $content,
                    'content' => $content,
                ]);
            }

            if ($content instanceof Book) {
                // Используем уже найденное размещение книги.
                $content->setRelation('placement', $placement);

                $content->load('authors');

                // Для страницы книги загружаем корневые главы
                // вместе со всеми дочерними уровнями.
                $content->setRelation(
                    'chapters',
                    $content->chapters()
                        ->whereNull('parent_id')
                        ->with('childrenRecursive')
                        ->get()
                );

                return view('pages.book', [
                    'book' => $content,
                    'content' => $content,
                ]);
            }
        }

        if ($placement->children->isNotEmpty()) {
            $subSections = $placement->children()
                ->orderBy('order_column', 'asc')
                ->get();

            return view('pages.section', [
                'placement' => $placement,
                'subSections' => $subSections,
                'content' => $placement,
            ]);
        }

        return view('pages.empty', [
            'placement' => $placement,
            'content' => $placement,
        ]);
    }

    public function home(): View
    {
        // Главная страница имеет пустой full_slug.
        $homePlacement = Placement::where('full_slug', '')->first();

        $featured = Placement::where('show_on_main', true)
            ->with('placementable')
            ->orderBy('order_column', 'asc')
            ->limit(6)
            ->get();

        return view('home', [
            'featured' => $featured,
            'content' => $homePlacement,
        ]);
    }

    /**
     * Разбирает адрес главы вида:
     * "{путь книги}/{slugs предков}/{slug главы}".
     *
     * Возвращает страницу главы, перенаправление на вход
     * либо null, если адрес не соответствует главе.
     */
    protected function tryResolveChapter(
        string $searchSlug
    ): View|RedirectResponse|null {
        $segments = explode('/', trim($searchSlug, '/'));

        if (count($segments) < 2) {
            return null;
        }

        // Последний сегмент — slug искомой главы.
        $chapterSlug = array_pop($segments);

        // Определяем, какая часть пути относится к книге.
        $bookPlacement = null;
        $bookSegmentsCount = count($segments);

        while ($bookSegmentsCount > 0) {
            $candidatePath = implode(
                '/',
                array_slice($segments, 0, $bookSegmentsCount)
            );

            $candidate = Placement::where(
                'full_slug',
                $candidatePath
            )->first();

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

        // Проверяем защиту размещения книги и самой книги.
        if (
            ($bookPlacement->is_protected || $book->is_protected)
            && !Auth::check()
        ) {
            return redirect()->route('login');
        }

        $chapter = $book->chapters()
            ->where('slug', $chapterSlug)
            ->first();

        if (!$chapter) {
            return null;
        }

        // Проверяем, что промежуточные сегменты адреса
        // совпадают с реальной цепочкой предков главы.
        $expectedAncestorSlugs = array_slice(
            $segments,
            $bookSegmentsCount
        );

        $actualAncestorSlugs = $chapter
            ->getAncestors()
            ->pluck('slug')
            ->all();

        if ($expectedAncestorSlugs !== $actualAncestorSlugs) {
            return null;
        }

        // Передаём книге уже найденное размещение.
        $book->setRelation('placement', $bookPlacement);

        // Данные для страницы главы и её оглавления.
        $book->load('authors');

        $book->setRelation(
            'chapters',
            $book->chapters()
                ->whereNull('parent_id')
                ->with('childrenRecursive')
                ->get()
        );

        $query = request()->input('q') ?? session('last_search_query');

        if ($query) {
            $chapter = $this->highlightContent($chapter, $query);
        }

        $breadcrumbs = [
            [
                'title' => 'Главная',
                'url' => url('/'),
            ],
            [
                'title' => $book->title,
                'url' => $book->getUrl(),
            ],
        ];

        foreach ($chapter->getAncestors() as $ancestor) {
            $breadcrumbs[] = [
                'title' => $ancestor->title,
                'url' => $ancestor->getUrl(),
            ];
        }

        $breadcrumbs[] = [
            'title' => $chapter->title,
        ];

        return view('pages.chapter', [
            'chapter' => $chapter,
            'book' => $book,
            'content' => $chapter,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    protected function highlightContent(Model $content, string $query): Model
    {
        if (empty($query)) {
            return $content;
        }

        try {
            $modelClass = get_class($content);

            // Проверяем поддержку Scout.
            if (class_exists($modelClass) && method_exists($modelClass, 'search')) {
                $results = $modelClass::search($query)->get();

                $matched = $results->firstWhere(
                    'id',
                    $content->id ?? null
                );

                if ($matched) {
                    $pattern = '/' . preg_quote($query, '/') . '/iu';

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
                logger()->warning(
                    "Model {$modelClass} не поддерживает Scout::search()"
                );
            }
        } catch (Throwable $e) {
            logger()->error(
                'Highlight failed: ' . $e->getMessage()
            );
        }

        return $content;
    }
}
