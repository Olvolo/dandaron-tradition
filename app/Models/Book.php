<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'description',
        'annotation',
        'custom_styles',
    ];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class)->orderBy('order_column');
    }
    /**
     * Определяет данные модели, которые должны индексироваться.
     */
    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'annotation' => $this->annotation,
            'description' => strip_tags($this->description),
        ];
    }
    public function placement(): MorphOne
    {
        return $this->morphOne(Placement::class, 'placementable');
    }
}
