<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Laravel\Scout\Searchable;

/**
 * @property mixed $authors
 * @property mixed $custom_styles
 * @property mixed $annotation
 * @property mixed $title
 * @property mixed $description
 * @method static find($id)
 * @method static updateOrCreate(array $array, array $validatedData)
 */
class Book extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'description',
        'annotation',
        'custom_styles',
        'is_protected',
        'background_image_url',
        'custom_styles',
    ];
    protected $casts = ['is_protected' => 'boolean'];
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
    public function getUrl()
    {
        if ($this->placement) {
            return url($this->placement->full_slug);
        }
        return '#';
    }
    public function getTypeName()
    {
        return 'Книга';
    }
}
