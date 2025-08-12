<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\Article;
//use App\Models\Book;
//use App\Models\Chapter;
//use Illuminate\Http\Request;
//
//class SearchController extends Controller
//{
//    public function __invoke(Request $request)
//    {
//        $query = trim($request->input('q', ''));
//
//        if (empty($query)) {
//            return view('search.index', [
//                'results' => collect(),
//                'query' => ''
//            ]);
//        }
//
//        $queryWords = explode(' ', $query);
//        $results = collect();
//
//        // Поиск в статьях
//        $articles = Article::query()->with('placement');
//        foreach ($queryWords as $word) {
//            $articles->where(function ($q) use ($word) {
//                $q->where('title', 'like', "%$word%")
//                    ->orWhere('annotation', 'like', "%$word%")
//                    ->orWhere('content_html', 'like', "%$word%");
//            });
//        }
//
//        foreach ($articles->get() as $article) {
//            $results->push($this->formatResult($article, $queryWords));
//        }
//
//        // Поиск в книгах
//        $books = Book::query()->with('placement');
//        foreach ($queryWords as $word) {
//            $books->where(function ($q) use ($word) {
//                $q->where('title', 'like', "%$word%")
//                    ->orWhere('annotation', 'like', "%$word%")
//                    ->orWhere('description', 'like', "%$word%");
//            });
//        }
//
//        foreach ($books->get() as $book) {
//            $results->push($this->formatResult($book, $queryWords));
//        }
//
//        // Поиск в главах
//        $chapters = Chapter::query()->with('placement');
//        foreach ($queryWords as $word) {
//            $chapters->where(function ($q) use ($word) {
//                $q->where('title', 'like', "%$word%")
//                    ->orWhere('content_html', 'like', "%$word%");
//            });
//        }
//
//        foreach ($chapters->get() as $chapter) {
//            $results->push($this->formatResult($chapter, $queryWords));
//        }
//
//        return view('search.index', [
//            'results' => $results,
//            'query' => $query
//        ]);
//    }
//
//    private function formatResult($model, array $queryWords): object
//    {
//        // Определяем поле с основным контентом
//        $contentField = null;
//        if (isset($model->content_html)) {
//            $contentField = 'content_html';
//        } elseif (isset($model->description)) {
//            $contentField = 'description';
//        } elseif (isset($model->annotation)) {
//            $contentField = 'annotation';
//        }
//
//        $content = $contentField ? strip_tags($model->{$contentField}) : '';
//        $fragments = $this->createFragments($content, $queryWords);
//
//        return (object)[
//            'title' => $this->highlightText($model->title, $queryWords),
//            'type' => $model->getTypeName(),
//            'url' => $model->getUrl(),
//            'fragments' => $fragments,
//            'model' => $model
//        ];
//    }
//
//    private function createFragments(string $content, array $queryWords): array
//    {
//        if (empty($content)) return [];
//
//        $fragments = [];
//
//        foreach ($queryWords as $word) {
//            $pos = mb_stripos($content, $word);
//            if ($pos !== false) {
//                // Берем 100 символов до и после найденного слова
//                $start = max(0, $pos - 100);
//                $length = 200;
//
//                $fragment = mb_substr($content, $start, $length);
//
//                // Добавляем троеточие: ...
//                if ($start > 0) $fragment = '...' . $fragment;
//                if ($start + $length < mb_strlen($content)) $fragment .= '...';
//
//                // Выделяем найденное слово
//                $fragment = $this->highlightText($fragment, [$word]);
//
//                $fragments[] = $fragment;
//                break; // Берем только первый фрагмент
//            }
//        }
//
//        return $fragments;
//    }
//
//    private function highlightText(string $text, array $words): string
//    {
//        foreach ($words as $word) {
//            $text = str_ireplace(
//                $word,
//                '<span style="background: #fef08a; font-weight: bold; padding: 1px 3px; border-radius: 2px;">' . $word . '</span>',
//                $text
//            );
//        }
//        return $text;
//    }
//}


namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Placement;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = trim($request->input('q', ''));

        // Получаем настройки для страницы поиска (если есть)
        $searchPlacement = Placement::where('full_slug', 'search')->first();

        if (empty($query)) {
            return view('search.index', [
                'results' => collect(),
                'query' => '',
                'content' => $searchPlacement
            ]);
        }

        $queryWords = explode(' ', $query);
        $results = collect();

        // Поиск в статьях
        $articles = Article::query()->with('placement');
        foreach ($queryWords as $word) {
            $articles->where(function ($q) use ($word) {
                $q->where('title', 'like', "%$word%")
                    ->orWhere('annotation', 'like', "%$word%")
                    ->orWhere('content_html', 'like', "%$word%");
            });
        }

        foreach ($articles->get() as $article) {
            $results->push($this->formatResult($article, $queryWords));
        }

        // Поиск в книгах
        $books = Book::query()->with('placement');
        foreach ($queryWords as $word) {
            $books->where(function ($q) use ($word) {
                $q->where('title', 'like', "%$word%")
                    ->orWhere('annotation', 'like', "%$word%")
                    ->orWhere('description', 'like', "%$word%");
            });
        }

        foreach ($books->get() as $book) {
            $results->push($this->formatResult($book, $queryWords));
        }

        // Поиск в главах
        $chapters = Chapter::query()->with('placement');
        foreach ($queryWords as $word) {
            $chapters->where(function ($q) use ($word) {
                $q->where('title', 'like', "%$word%")
                    ->orWhere('content_html', 'like', "%$word%");
            });
        }

        foreach ($chapters->get() as $chapter) {
            $results->push($this->formatResult($chapter, $queryWords));
        }

        return view('search.index', [
            'results' => $results,
            'query' => $query,
            'content' => $searchPlacement  // Передаем content для стилей
        ]);
    }

    private function formatResult($model, array $queryWords): object
    {
        // Определяем поле с основным контентом
        $contentField = null;
        if (isset($model->content_html)) {
            $contentField = 'content_html';
        } elseif (isset($model->description)) {
            $contentField = 'description';
        } elseif (isset($model->annotation)) {
            $contentField = 'annotation';
        }

        $content = $contentField ? strip_tags($model->{$contentField}) : '';
        $fragments = $this->createFragments($content, $queryWords);

        return (object)[
            'title' => $this->highlightText($model->title, $queryWords),
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
