<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
use App\Models\Placement;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Meilisearch\Client as MeilisearchClient;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function show(string $slug = null): View|RedirectResponse
    {
        $searchSlug = $slug ?? '';
        $placement = Placement::where('full_slug', $searchSlug)->firstOrFail();

        if ($placement->is_protected && !Auth::check()) {
            return redirect()->route('login');
        }
        $placement->load(['placementable', 'children.parent']);

        if ($placement->placementable) {
            $content = $placement->placementable;
            $query = request()->input('q') ?? session('last_search_query');

            if (property_exists($content, 'is_protected') && $content->is_protected && !Auth::check()) {
                return redirect()->route('login');
            }

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
            return view('pages.section', [
                'placement' => $placement,
                'subSections' => $placement->children,
                'content' => $placement
            ]);
        }

        return view('pages.empty', ['placement' => $placement, 'content' => $placement]);
    }

    public function home()
    {
        $featured = Placement::where('show_on_main', true)
            ->with('placementable')
            ->limit(6)
            ->get();

        return view('home', compact('featured'));
    }
    protected function highlightContent($content, string $query)
    {
        if (empty($query)) return $content;

        try {
            $modelClass = get_class($content);
            $indexName = config('scout.prefix').Str::plural(Str::lower($modelClass));

            $search = new MeilisearchClient(config('scout.meilisearch.host'));
            $result = $search->index($indexName)->search($query, [
                'filter' => "id = $content->id",
                'attributesToHighlight' => ['*'],
                'highlightPreTag' => '<mark class="search-highlight">',
                'highlightPostTag' => '</mark>',
                'limit' => 1
            ]);

            if (!empty($result->getHits())) {
                $highlighted = $result->getHits()[0]['_formatted'];
                foreach ($highlighted as $field => $value) {
                    if (property_exists($content, $field)) {
                        $content->$field = $value;
                    }
                }
            }
        } catch (Exception $e) {
            logger()->error("Highlight failed for $modelClass: ".$e->getMessage());
        }

        return $content;
    }
}
