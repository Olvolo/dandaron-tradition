<?php

namespace App\Http\Controllers;

use App\Models\Placement;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug = 'home')
    {
        // TODO: Реализовать логику поиска по вложенным slug'ам
        $placement = Placement::where('slug', $slug)->with(['placementable', 'children'])->firstOrFail();

        // Логика "файловой системы":
        // Если у элемента есть дочерние элементы, он в первую очередь является "папкой" (разделом).
        // Мы показываем шаблон раздела, который может отобразить и описание самого раздела (если оно есть), и ссылки на дочерние элементы.
        if ($placement->children->isNotEmpty()) {
            return view('pages.section', [
                'placement' => $placement,
                'subSections' => $placement->children
            ]);
        }

        // Если дочерних элементов нет, но есть привязанный контент, значит это "файл".
        // Показываем этот контент.
        if ($placement->placementable) {
            $content = $placement->placementable;

            if ($content instanceof \App\Models\Article) {
                return view('pages.article', ['article' => $content]);
            }

            if ($content instanceof \App\Models\Book) {
                $content->load(['authors', 'chapters']);
                return view('pages.book', ['book' => $content]);
            }
        }

        // Если нет ни дочерних элементов, ни контента - это пустая страница-раздел.
        return "Этот раздел пока пуст.";
    }
}
