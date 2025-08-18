<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\Article;
//use App\Models\Book;
//use App\Models\Chapter;
//use App\Models\Placement;
//use Illuminate\Http\Request;
//
//class SearchController extends Controller
//{
//    public function __invoke(Request $request)
//    {
//        $query = trim($request->input('q', ''));
//
//        // Получаем настройки для страницы поиска (если есть)
//        $searchPlacement = Placement::where('full_slug', 'search')->first();
//
//        if (empty($query)) {
//            return view('search.index', [
//                'results' => collect(),
//                'query' => '',
//                'content' => $searchPlacement
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
//            'query' => $query,
//            'content' => $searchPlacement  // Передаем content для стилей
//        ]);
//    }
//
//    private function formatResult($model, array $queryWords): object
//    {
//        // Define the content field
//        $contentField = match(get_class($model)) {
//            Article::class, Chapter::class => 'content_html',
//            Book::class => 'description',
//            default => null
//        };
//
//        // NEW LOGIC FOR CHAPTER TITLES
//        if ($model instanceof Chapter) {
//            $model->load('book'); // Make sure the book relationship is loaded
//            $title = $model->book->title . ' / ' . $model->title;
//        } else {
//            $title = $model->title;
//        }
//
//        $content = $contentField ? strip_tags($model->{$contentField}) : '';
//        $fragments = $this->createFragments($content, $queryWords);
//
//        return (object)[
//            'title' => $this->highlightText($title, $queryWords), // Use the new combined title
//            'type' => $model->getTypeName(),
//            'url' => $model->getUrl(),
//            'fragments' => $fragments,
//            'model' => $model
//        ];
//    }
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
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Placement;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        // 1. Read all inputs from the request
        $query = trim($request->input('q', ''));
        $selectedCategoryId = $request->input('category');
        $selectedTagId = $request->input('tag');

        // 2. Fetch all categories and tags for the filter dropdowns
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();

        $searchPlacement = Placement::where('full_slug', 'search')->first();
        $results = collect();

        // Only run search if there's a query or a filter selected
        if (!empty($query) || $selectedCategoryId || $selectedTagId) {
            $queryWords = explode(' ', $query);

            // 3. Search in Articles, now with filters
            $articlesQuery = Article::query()->with('placement');

            // Apply category filter if selected
            if ($selectedCategoryId) {
                $articlesQuery->whereHas('categories', function ($q) use ($selectedCategoryId) {
                    $q->where('id', $selectedCategoryId);
                });
            }

            // Apply tag filter if selected
            if ($selectedTagId) {
                $articlesQuery->whereHas('tags', function ($q) use ($selectedTagId) {
                    $q->where('id', $selectedTagId);
                });
            }

            // Apply text search if query is present
            if (!empty($query)) {
                foreach ($queryWords as $word) {
                    $articlesQuery->where(function ($q) use ($word) {
                        $q->where('title', 'like', "%$word%")
                            ->orWhere('annotation', 'like', "%$word%")
                            ->orWhere('content_html', 'like', "%$word%");
                    });
                }
            }

            foreach ($articlesQuery->get() as $article) {
                $results->push($this->formatResult($article, $queryWords));
            }

            // Searches for Books and Chapters remain unchanged as they don't have categories/tags
            if (!$selectedCategoryId && !$selectedTagId && !empty($query)) {
                // Book search
                $books = Book::query()->with('placement');
                foreach ($queryWords as $word) {
                    $books->where(function ($q) use ($word) {
                        $q->where('title', 'like', "%$word%")->orWhere('annotation', 'like', "%$word%")->orWhere('description', 'like', "%$word%");
                    });
                }
                foreach ($books->get() as $book) {
                    $results->push($this->formatResult($book, $queryWords));
                }

                // Chapter search
                $chapters = Chapter::query()->with('placement');
                foreach ($queryWords as $word) {
                    $chapters->where(function ($q) use ($word) {
                        $q->where('title', 'like', "%$word%")->orWhere('content_html', 'like', "%$word%");
                    });
                }
                foreach ($chapters->get() as $chapter) {
                    $results->push($this->formatResult($chapter, $queryWords));
                }
            }
        }

        return view('search.index', [
            'results' => $results,
            'query' => $query,
            'categories' => $categories, // Pass categories to the view
            'tags' => $tags,             // Pass tags to the view
            'content' => $searchPlacement
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
            $model->load('book'); // Make sure the book relationship is loaded
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
