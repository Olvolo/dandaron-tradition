<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
use App\Models\Placement;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class PageController extends Controller
{
    public function show($slug = null): View|Application|Factory // Убрали 'home' по умолчанию
    {
        // Если URL пустой, ищем главную страницу. Иначе ищем по полному слагу.
        $searchSlug = $slug ?? '';

        $placement = Placement::where('full_slug', $searchSlug)->firstOrFail();

        // --- Вся остальная логика остается без изменений ---

        $placement->load(['placementable', 'children']);

        if ($placement->placementable) {
            $content = $placement->placementable;
            if ($content instanceof Article) {
                return view('pages.article', ['article' => $content]);
            }
            if ($content instanceof Book) {
                $content->load(['authors', 'chapters.childrenRecursive']);
                return view('pages.book', ['book' => $content]);
            }
        }

        if ($placement->children->isNotEmpty()) {
            $subSections = $placement->children()->with('parent.parent')->get(); // Упростили загрузку
            return view('pages.section', ['placement' => $placement, 'subSections' => $subSections]);
        }

        return view('pages.empty', ['placement' => $placement]);
    }
}
