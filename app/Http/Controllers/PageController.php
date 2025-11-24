<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
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
        $placement = Placement::where('full_slug', $searchSlug)->firstOrFail();

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
