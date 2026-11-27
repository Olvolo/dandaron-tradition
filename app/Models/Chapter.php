<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Chapter extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'book_id',
        'parent_id',
        'order_column',
        'title',
        'slug',
        'content_html',
        'custom_styles',
        'background_image_url',
    ];

    /**
     * Непосредственные дочерние главы.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Chapter::class, 'parent_id')
            ->orderBy('order_column');
    }

    /**
     * Рекурсивная загрузка дерева дочерних глав.
     */
    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    /**
     * Родительская глава.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'parent_id');
    }

    /**
     * Книга, к которой относится глава.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Размещение книги в общей структуре сайта.
     */
    public function placement(): MorphOne
    {
        return $this->morphOne(Placement::class, 'placementable');
    }

    /**
     * Подготовка данных для поискового индекса.
     */
    public function toSearchableArray(): array
    {
        $content = $this->content_html ?? '';

        $plainText = html_entity_decode(
            strip_tags($content),
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        );

        $plainText = preg_replace('/\s+/u', ' ', $plainText) ?? '';

        return [
            'id' => $this->id,
            'title' => $this->title ?? '',
            'content_html' => Str::substr(trim($plainText), 0, 10000),
        ];
    }

    /**
     * Получение всех предков главы:
     * от корневой главы до непосредственного родителя.
     *
     * Учитываются только главы той же книги.
     * Предусмотрена защита от циклических связей.
     */
    public function getAncestors(): Collection
    {
        $ancestors = collect();

        $visited = [
            (int) $this->id => true,
        ];

        $parentId = $this->parent_id;

        while ($parentId !== null) {
            $parentId = (int) $parentId;

            // Защита от циклической связи.
            if (isset($visited[$parentId])) {
                break;
            }

            $visited[$parentId] = true;

            // Получаем родителя только из текущей книги.
            $ancestor = self::query()
                ->where('book_id', $this->book_id)
                ->whereKey($parentId)
                ->first([
                    'id',
                    'book_id',
                    'parent_id',
                    'title',
                    'slug',
                    'order_column',
                ]);

            // Если родитель отсутствует или относится к другой книге,
            // дальнейшее построение цепочки прекращается.
            if (!$ancestor) {
                break;
            }

            $ancestors->push($ancestor);

            $parentId = $ancestor->parent_id;
        }

        return $ancestors->reverse()->values();
    }

    /**
     * Построение полного адреса главы:
     *
     * {адрес размещения книги}/{slug предка}/{slug главы}
     */
    public function getUrl(): string
    {
        /** @var \App\Models\Book|null $book */
        $book = $this->relationLoaded('book')
            ? $this->book
            : $this->book()->first();

        if (!$book) {
            return '#';
        }

        $book->loadMissing('placement');

        if (!$book->placement) {
            return '#';
        }

        $pathSegments = $this->getAncestors()
            ->pluck('slug')
            ->push($this->slug)
            ->filter(fn ($slug) => $slug !== null && $slug !== '');

        if ($pathSegments->isEmpty()) {
            return '#';
        }

        $basePath = trim($book->placement->full_slug, '/');
        $chapterPath = $pathSegments->implode('/');

        $fullPath = $basePath !== ''
            ? $basePath . '/' . $chapterPath
            : $chapterPath;

        return url($fullPath);
    }

    /**
     * Название типа содержимого.
     */
    public function getTypeName(): string
    {
        return 'Глава';
    }

    /**
     * Формирование очищенного описания для SEO.
     */
    public function getSeoDescription(): string
    {
        $text = $this->content_html ?? '';

        if ($text === '') {
            $book = $this->relationLoaded('book')
                ? $this->book
                : $this->book()->first();

            $bookTitle = $book?->title ?? 'наследия Дандарона';

            $text = 'Глава «' . $this->title . '» из книги ' . $bookTitle;
        }

        $clean = html_entity_decode(
            strip_tags($text),
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        );

        $clean = preg_replace('/\s+/u', ' ', $clean) ?? '';

        return Str::limit(trim($clean), 155);
    }

    /**
     * Возвращает содержимое главы с абсолютными адресами
     * для ссылок на сноски и примечания.
     *
     * Обрабатываются ссылки вида:
     * #citation-N
     * #ref-N
     */
    public function getContentWithAbsoluteAnchors(): string
    {
        $content = $this->content_html ?? '';

        /** @var \App\Models\Book|null $book */
        $book = $this->relationLoaded('book')
            ? $this->book
            : $this->book()->first();

        if (!$book) {
            return $content;
        }

        $bookUrl = $book->getUrl();

        return preg_replace_callback(
            '/href=(["\'])#(citation-\d+|ref-\d+)\1/',
            function ($matches) use ($bookUrl) {
                return 'href="' .
                    htmlspecialchars($bookUrl, ENT_QUOTES, 'UTF-8') .
                    '#' . $matches[2] . '"';
            },
            $content
        ) ?? $content;
    }
}
