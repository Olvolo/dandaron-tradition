<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Laravel\Scout\Searchable;

/**
 * @method static where(string $string, string $string1, $article_id)
 * @method static updateOrCreate(array $array, array $validatedData)
 * @method static find($id)
 * @property mixed $title
 * @property mixed $annotation
 * @property mixed $content_html
 */
class Article extends Model
{
    use HasFactory, Searchable;

    /**
     * Атрибуты, разрешённые для массового заполнения.
     */
    protected $fillable = [
        'parent_id',
        'title',
        'annotation',
        'content_html',
        'custom_styles',
        'is_protected',
        'background_image_url',
        'custom_styles',
    ];
    protected $casts = ['is_protected' => 'boolean'];
    /**
     * Связь с родительской статьёй.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'parent_id');
    }

    /**
     * Связь с дочерними статьями (подразделами).
     */
    public function children(): HasMany
    {
        return $this->hasMany(Article::class, 'parent_id');
    }
    /**
     * Авторы этой статьи.
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_article');
    }

    /**
     * Категории этой статьи.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }

    /**
     * Теги этой статьи.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }
    /**
     * Определяет данные модели, которые должны индексироваться.
     */
    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'annotation' => $this->annotation,
            'content_html' => strip_tags($this->content_html),
        ];
    }
    public function placement(): MorphOne
    {
        return $this->morphOne(Placement::class, 'placementable');
    }
    public function getUrl()
    {
        if ($this->placement) {
            return url($this->placement->full_slug);
        }
        return '#';
    }

    public function getFixedContentAttribute(): string
    {
        // Убираем двойное экранирование
        $fixed = html_entity_decode($this->content_html, ENT_QUOTES, 'UTF-8');
        // На случай тройного экранирования (редко, но бывает)
        $fixed = html_entity_decode($fixed, ENT_QUOTES, 'UTF-8');
        return $fixed;
    }
}
