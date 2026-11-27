<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Placement;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    /**
     * Обработка поискового запроса.
     */
    public function __invoke(Request $request)
    {
        // Поисковая строка.
        $inputQuery = $request->input('q', '');
        $query = is_string($inputQuery) ? trim($inputQuery) : '';

        // Идентификаторы фильтров.
        $selectedCategoryId = $request->integer('category') ?: null;
        $selectedTagId = $request->integer('tag') ?: null;

        // Справочники для формы поиска.
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();

        // Размещение страницы поиска.
        $searchPlacement = Placement::where('full_slug', 'search')->first();

        $results = collect();

        // Разбиваем запрос на отдельные слова.
        $queryWords = $query !== ''
            ? (preg_split('/\s+/u', $query, -1, PREG_SPLIT_NO_EMPTY) ?: [])
            : [];

        $isAuthenticated = Auth::check();

        // Поиск выполняется при наличии запроса или фильтров.
        if ($query !== '' || $selectedCategoryId || $selectedTagId) {

            /*
             * 1. ПОИСК СТАТЕЙ
             */

            if ($query !== '') {
                // Поиск через Laravel Scout / TNTSearch.
                $articles = Article::search($query)->get();
            } else {
                // Если запрос пустой, используем фильтры базы данных.
                $articleQuery = Article::query();

                if ($selectedCategoryId) {
                    $articleQuery->whereHas(
                        'categories',
                        fn ($builder) => $builder->where(
                            'categories.id',
                            $selectedCategoryId
                        )
                    );
                }

                if ($selectedTagId) {
                    $articleQuery->whereHas(
                        'tags',
                        fn ($builder) => $builder->where(
                            'tags.id',
                            $selectedTagId
                        )
                    );
                }

                $articles = $articleQuery->get();
            }

            // Загружаем необходимые связи.
            $articles->loadMissing([
                'placement',
                'parent',
                'categories',
                'tags',
            ]);

            // Фильтры для результатов Scout.
            if ($query !== '' && $selectedCategoryId) {
                $articles = $articles->filter(
                    fn ($article) => $article->categories->contains(
                        'id',
                        $selectedCategoryId
                    )
                );
            }

            if ($query !== '' && $selectedTagId) {
                $articles = $articles->filter(
                    fn ($article) => $article->tags->contains(
                        'id',
                        $selectedTagId
                    )
                );
            }

            foreach ($articles as $article) {
                $isProtected = (bool) $article->is_protected
                    || (bool) ($article->placement?->is_protected ?? false);

                $canShowContent = $isAuthenticated || !$isProtected;

                $results->push(
                    $this->formatResult(
                        $article,
                        $queryWords,
                        $canShowContent
                    )
                );
            }

            /*
             * 2. ПОИСК КНИГ
             *
             * Категории и теги к книгам не применяются.
             */

            if ($query !== '') {
                $books = Book::search($query)->get();

                $books->loadMissing('placement');

                foreach ($books as $book) {
                    $isProtected = (bool) $book->is_protected
                        || (bool) ($book->placement?->is_protected ?? false);

                    $canShowContent = $isAuthenticated || !$isProtected;

                    $results->push(
                        $this->formatResult(
                            $book,
                            $queryWords,
                            $canShowContent
                        )
                    );
                }

                /*
                 * 3. ПОИСК ГЛАВ
                 *
                 * Защита главы определяется защитой книги
                 * и размещения этой книги.
                 */

                $chapters = Chapter::search($query)->get();

                $chapters->loadMissing('book.placement');

                foreach ($chapters as $chapter) {
                    $book = $chapter->book;

                    // Если книга отсутствует, содержимое скрывается
                    // от гостей, поскольку проверить защиту невозможно.
                    $isProtected = $book === null || (
                        (bool) $book->is_protected
                        || (bool) ($book->placement?->is_protected ?? false)
                    );

                    $canShowContent = $isAuthenticated || !$isProtected;

                    $results->push(
                        $this->formatResult(
                            $chapter,
                            $queryWords,
                            $canShowContent
                        )
                    );
                }
            }
        }

        return view('search.index', [
            'results' => $results,
            'query' => $query,
            'categories' => $categories,
            'tags' => $tags,
            'content' => $searchPlacement,
        ]);
    }

    /**
     * Подготавливает единый объект результата поиска.
     *
     * Защищённое содержимое не передаётся в представление,
     * если текущему посетителю запрещён его просмотр.
     */
    private function formatResult(
        Article|Book|Chapter $model,
        array $queryWords,
        bool $canShowContent
    ): object {
        // Определяем поле с содержимым.
        $contentField = match (true) {
            $model instanceof Article => 'content_html',
            $model instanceof Book => 'description',
            $model instanceof Chapter => 'content_html',
        };

        // Формируем заголовок.
        if ($model instanceof Chapter) {
            $model->loadMissing('book');

            $title = ($model->book?->title ?? 'Книга')
                . ' / '
                . $model->title;
        } else {
            $title = $model->title ?? '';
        }

        $fragments = [];
        $description = '';

        if ($canShowContent) {
            // Получаем и очищаем текст для поискового фрагмента.
            $content = $model->{$contentField} ?? '';

            if ($content !== '') {
                $plainText = html_entity_decode(
                    strip_tags($content),
                    ENT_QUOTES | ENT_HTML5,
                    'UTF-8'
                );

                $plainText = preg_replace('/\s+/u', ' ', $plainText) ?? '';

                if ($queryWords !== []) {
                    $fragments = $this->createFragments(
                        $plainText,
                        $queryWords
                    );
                }
            }

            // Формируем запасное описание.
            if ($model instanceof Article) {
                $description = $model->annotation ?? '';
            } elseif ($model instanceof Book) {
                $description = $model->annotation ?: $model->description;
            }

            $description = html_entity_decode(
                strip_tags($description),
                ENT_QUOTES | ENT_HTML5,
                'UTF-8'
            );

            $description = preg_replace(
                '/\s+/u',
                ' ',
                $description
            ) ?? '';

            $description = Str::limit(trim($description), 250);
        }

        return (object) [
            'title' => $this->highlightText($title, $queryWords),
            'type' => $model->getTypeName(),
            'url' => $model->getUrl(),
            'fragments' => $fragments,
            'description' => $description,
        ];
    }

    /**
     * Создаёт первый найденный фрагмент текста.
     */
    private function createFragments(
        string $content,
        array $queryWords
    ): array {
        if ($content === '' || $queryWords === []) {
            return [];
        }

        $contentLength = mb_strlen($content, 'UTF-8');

        foreach ($queryWords as $word) {
            if ($word === '') {
                continue;
            }

            $position = mb_stripos($content, $word, 0, 'UTF-8');

            if ($position === false) {
                continue;
            }

            // Берём до 100 символов перед найденным словом.
            $start = max(0, $position - 100);

            // Максимальная длина фрагмента.
            $excerpt = mb_substr(
                $content,
                $start,
                200,
                'UTF-8'
            );

            $excerptLength = mb_strlen($excerpt, 'UTF-8');

            if ($start > 0) {
                $excerpt = '...' . $excerpt;
            }

            if ($start + $excerptLength < $contentLength) {
                $excerpt .= '...';
            }

            return [
                $this->highlightText($excerpt, [$word]),
            ];
        }

        return [];
    }

    /**
     * Безопасно выделяет найденные слова.
     *
     * Исходный текст экранируется.
     * HTML-разметка подсветки добавляется только этим методом.
     */
    private function highlightText(
        string $text,
        array $words
    ): string {
        $words = array_values(array_filter(
            $words,
            fn ($word) => is_string($word) && $word !== ''
        ));

        if ($words === []) {
            return htmlspecialchars(
                $text,
                ENT_QUOTES | ENT_SUBSTITUTE,
                'UTF-8'
            );
        }

        // Сначала обрабатываем более длинные слова.
        usort(
            $words,
            fn ($a, $b) => mb_strlen($b, 'UTF-8')
                <=> mb_strlen($a, 'UTF-8')
        );

        $quotedWords = array_map(
            fn ($word) => preg_quote($word, '/'),
            $words
        );

        $pattern = '/(' . implode('|', $quotedWords) . ')/iu';

        $parts = preg_split(
            $pattern,
            $text,
            -1,
            PREG_SPLIT_DELIM_CAPTURE
        );

        if ($parts === false) {
            return htmlspecialchars(
                $text,
                ENT_QUOTES | ENT_SUBSTITUTE,
                'UTF-8'
            );
        }

        $result = '';

        foreach ($parts as $index => $part) {
            $escapedPart = htmlspecialchars(
                $part,
                ENT_QUOTES | ENT_SUBSTITUTE,
                'UTF-8'
            );

            if ($index % 2 === 1) {
                $result .= '<mark class="search-highlight">'
                    . $escapedPart
                    . '</mark>';
            } else {
                $result .= $escapedPart;
            }
        }

        return $result;
    }
}
