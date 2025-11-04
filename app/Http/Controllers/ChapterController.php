<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ChapterController extends Controller
{
    public function show(Chapter $chapter): View
    {
        $chapter->load('book');

        $query = request()->input('q') ?? session('last_search_query');

        if ($query) {
            $chapter = $this->highlightContent($chapter, $query);
        }

        return view('pages.chapter', [
            'chapter' => $chapter,
            'book' => $chapter->book,
            'content' => $chapter,
        ]);
    }

    protected function highlightContent(Chapter $chapter, string $query): Chapter
    {
        // Поиск в Scout (TNTSearch)
        $results = Chapter::search($query)->get();

        // Находим именно текущую главу в результатах
        $matched = $results->firstWhere('id', $chapter->id);

        if ($matched) {
            $content = $chapter->content_html;
            // Простая подсветка найденного слова
            $pattern = '/' . preg_quote($query, '/') . '/iu';
            $chapter->content_html = preg_replace(
                $pattern,
                '<mark class="search-highlight">$0</mark>',
                $content
            );
        }

        return $chapter;
    }
}
