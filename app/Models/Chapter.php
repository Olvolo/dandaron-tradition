<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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
    ];
    // Связь с дочерними элементами (один уровень)
    public function children(): HasMany
    {
        return $this->hasMany(Chapter::class, 'parent_id')->orderBy('order_column');
    }

    // НОВЫЙ МЕТОД: Рекурсивная связь для загрузки всего дерева
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
}
