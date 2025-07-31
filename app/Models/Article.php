<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    /**
     * Атрибуты, разрешённые для массового заполнения.
     */
    protected $fillable = [
        'parent_id',
        'title',
        'annotation',
        'content_html',
        'custom_styles',
    ];

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
}
