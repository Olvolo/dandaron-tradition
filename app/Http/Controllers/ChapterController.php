<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Exception;
use Illuminate\View\View;
use Meilisearch\Client as MeilisearchClient;

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
        try {
            $search = new MeilisearchClient(config('scout.meilisearch.host'));
            $result = $search->index(config('scout.prefix').'chapters')->search($query, [
                'filter' => ['id = '.$chapter->id],
                'attributesToHighlight' => ['content_html'],
                'highlightPreTag' => '<mark class="search-highlight">',
                'highlightPostTag' => '</mark>',
                'limit' => 1
            ]);

            if (count($result->getHits()) > 0) {
                $highlighted = $result->getHits()[0]['_formatted'];
                $chapter->content_html = $highlighted['content_html'] ?? $chapter->content_html;
            }
        } catch (Exception $e) {
            logger()->error('Meilisearch highlight error: '.$e->getMessage());
        }

        return $chapter;
    }
}
