<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;
use Laravel\Scout\Searchable;
use Illuminate\Support\Str;

/**
 * @property mixed $content_html
 * @property mixed $title
 * @property mixed $id
 * @property mixed $parent
 * @property mixed $book
 * @method static find($chapterId)
 * @method static findOrFail($chapterId)
 */
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

    public function children(): HasMany
    {
        return $this->hasMany(Chapter::class, 'parent_id')->orderBy('order_column');
    }

    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'parent_id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function placement(): MorphOne
    {
        return $this->morphOne(Placement::class, 'placementable');
    }

    /**
     * Определяет данные модели, которые должны индексироваться.
     */
    public function toSearchableArray(): array
    {
        $content = $this->content_html ?? '';
        return [
            'id' => $this->id,
            'title' => $this->title ?? '',
            'content_html' => substr(strip_tags($content), 0, 10000),
        ];
    }

    /**
     * Список всех предков главы (родительские главы вверх по дереву),
     * от самого верхнего к непосредственному родителю.
     */
    public function getAncestors(): Collection
    {
        $ancestors = collect();
        $current = $this->parent;

        while ($current !== null) {
            $ancestors->push($current);
            $current = $current->parent;
        }

        return $ancestors->reverse()->values();
    }

    /**
     * Адрес главы строится как
     * {full_slug книги}/{slug предка 1}/{slug предка 2}/.../{slug главы},
     * то есть полностью отражает вложенность в дереве глав.
     */
    public function getUrl(): string
    {
        $book = $this->relationLoaded('book') ? $this->book : $this->book()->first();

        if (!$book || !$book->placement) {
            return '#';
        }

        $pathSegments = $this->getAncestors()->pluck('slug')->push($this->slug);

        return url(trim($book->placement->full_slug, '/') . '/' . $pathSegments->implode('/'));
    }

    public function getTypeName(): string
    {
        return 'Глава';
    }

    /**
     * Формирует очищенное описание для мета-тегов и Schema.org.
     */
    public function getSeoDescription(): string
    {
        $text = $this->content_html ?: ('Глава «' . $this->title . '» из книги ' . ($this->book->title ?? 'наследия Дандарона'));

        $clean = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($text))));

        return Str::limit($clean, 155);
    }
    /**
     * Возвращает content_html с абсолютными адресами для сносок/примечаний
     * (#citation-N, #ref-N), чтобы они работали и на странице книги целиком,
     * и на отдельной странице главы.
     */
    public function getContentWithAbsoluteAnchors(): string
    {
        $book = $this->relationLoaded('book') ? $this->book : $this->book()->first();

        if (!$book) {
            return $this->content_html ?? '';
        }

        $bookUrl = $book->getUrl();

        return preg_replace(
            '/href="#(citation-\d+|ref-\d+)"/',
            'href="' . $bookUrl . '#$1"',
            $this->content_html ?? ''
        );
    }
}
