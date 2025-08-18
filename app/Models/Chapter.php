<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Laravel\Scout\Searchable;

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
    /**
     * Определяет данные модели, которые должны индексироваться.
     */
    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'content_html' => strip_tags($this->content_html),
        ];
    }
    public function placement(): MorphOne
    {
        return $this->morphOne(Placement::class, 'placementable');
    }
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'parent_id');
    }
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
    public function getUrl(): string
    {
        return route('chapters.show', $this);
    }

    public function getTypeName()
    {
        return 'Глава';
    }
    public function getUrlAttribute()
    {
        return route('chapter.show', [$this->book->slug, $this->slug]);
    }
}
