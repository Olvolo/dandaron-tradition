<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return view('pages.results', ['results' => collect(), 'query' => '']);
        }

        // Задаем опции для поиска один раз
        $searchOptions = [
            'attributesToHighlight' => ['*'], // Искать во всех атрибутах
            'cropLength' => 40,               // Обрезать фрагмент до 40 слов
            'cropMarker' => '...',            // Добавлять многоточие, если текст обрезан
        ];

        // Выполняем поиск с новыми опциями
        $rawArticles = Article::search($query, fn($meili, $q) => $meili->search($q, $searchOptions))->raw();
        $articles = $this->hydrateResults(Article::class, $rawArticles);

        $rawBooks = Book::search($query, fn($meili, $q) => $meili->search($q, $searchOptions))->raw();
        $books = $this->hydrateResults(Book::class, $rawBooks);

        $rawChapters = Chapter::search($query, fn($meili, $q) => $meili->search($q, $searchOptions))->raw();
        $chapters = $this->hydrateResults(Chapter::class, $rawChapters);

        $results = $articles->merge($books)->merge($chapters);

        return view('pages.results', [
            'results' => $results,
            'query' => $query,
        ]);
    }

    private function hydrateResults(string $modelClass, array $rawResults): Collection
    {
        $ids = collect($rawResults['hits'])->pluck('id')->toArray();
        if (empty($ids)) {
            return collect();
        }

        $models = $modelClass::whereIn('id', $ids)->with('placement')->get()->keyBy('id');

        return collect($rawResults['hits'])->map(function ($hit) use ($models) {
            if (isset($models[$hit['id']])) {
                // Создаем простой объект-обертку
                return (object) [
                    'model' => $models[$hit['id']],
                    'formatted' => $hit['_formatted'] ?? [],
                ];
            }
            return null;
        })->filter();
    }
}
