<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Placement;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        // 1. Читаем параметры
        $query = trim($request->input('q', ''));
        $selectedCategoryId = $request->input('category');
        $selectedTagId = $request->input('tag');

        // 2. Загружаем справочники
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();

        $searchPlacement = Placement::where('full_slug', 'search')->first();
        $results = collect();

        // 3. Выполняем поиск
        if (!empty($query) || $selectedCategoryId || $selectedTagId) {

            // --- 🔹 ARTICLES через Scout ---
            $articles = Article::search($query)->get();

            // применяем фильтры к результатам TNTSearch (а не к БД!)
            if ($selectedCategoryId) {
                $articles = $articles->filter(fn($a) =>
                $a->categories->pluck('id')->contains($selectedCategoryId)
                );
            }
            if ($selectedTagId) {
                $articles = $articles->filter(fn($a) =>
                $a->tags->pluck('id')->contains($selectedTagId)
                );
            }

            foreach ($articles as $article) {
                $results->push($this->formatResult($article, explode(' ', $query)));
            }

            // --- 🔹 BOOKS через Scout ---
            $books = Book::search($query)->get();
            foreach ($books as $book) {
                $results->push($this->formatResult($book, explode(' ', $query)));
            }

            // --- 🔹 CHAPTERS через Scout ---
            $chapters = Chapter::search($query)->get();
            foreach ($chapters as $chapter) {
                $results->push($this->formatResult($chapter, explode(' ', $query)));
            }
        }

        // 4. Возвращаем представление
        return view('search.index', [
            'results' => $results,
            'query' => $query,
            'categories' => $categories,
            'tags' => $tags,
            'content' => $searchPlacement,
        ]);
    }


        private function formatResult($model, array $queryWords): object
    {
        // Define the content field
        $contentField = match(get_class($model)) {
            Article::class, Chapter::class => 'content_html',
            Book::class => 'description',
            default => null
        };

        // NEW LOGIC FOR CHAPTER TITLES
        if ($model instanceof Chapter) {
            $model->loadMissing('book');
            $title = $model->book->title . ' / ' . $model->title;
        } else {
            $title = $model->title;
        }

        $content = $contentField ? strip_tags($model->{$contentField}) : '';
        $fragments = $this->createFragments($content, $queryWords);

        return (object)[
            'title' => $this->highlightText($title, $queryWords), // Use the new combined title
            'type' => $model->getTypeName(),
            'url' => $model->getUrl(),
            'fragments' => $fragments,
            'model' => $model
        ];
    }
    private function createFragments(string $content, array $queryWords): array
    {
        if (empty($content)) return [];

        $fragments = [];

        foreach ($queryWords as $word) {
            $pos = mb_stripos($content, $word);
            if ($pos !== false) {
                // Берем 100 символов до и после найденного слова
                $start = max(0, $pos - 100);
                $length = 200;

                $fragment = mb_substr($content, $start, $length);

                // Добавляем троеточие: ...
                if ($start > 0) $fragment = '...' . $fragment;
                if ($start + $length < mb_strlen($content)) $fragment .= '...';

                // Выделяем найденное слово
                $fragment = $this->highlightText($fragment, [$word]);

                $fragments[] = $fragment;
                break; // Берем только первый фрагмент
            }
        }
        return $fragments;
    }

    private function highlightText(string $text, array $words): string
    {
        foreach ($words as $word) {
            $text = str_ireplace(
                $word,
                '<span style="background: #fef08a; font-weight: bold; padding: 1px 3px; border-radius: 2px;">' . $word . '</span>',
                $text
            );
        }
        return $text;
    }
}
