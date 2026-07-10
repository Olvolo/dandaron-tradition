<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Laravel\Scout\Searchable;
use Illuminate\Support\Str;

/**
 * @property mixed $authors
 * @property mixed $custom_styles
 * @property mixed $annotation
 * @property mixed $title
 * @property mixed $description
 * @property mixed $id
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
     * Определяет данные модели для поискового индекса.
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'annotation' => $this->annotation,
            'description' => strip_tags($this->description),
        ];
    }

    public function placement(): MorphOne
    {
        return $this->morphOne(Placement::class, 'placementable');
    }

    public function getUrl(): string
    {
        return $this->placement ? url($this->placement->full_slug) : '#';
    }

    public function getTypeName(): string
    {
        return 'Книга';
    }

    /**
     * Формирует очищенное описание для мета-тегов и Schema.org.
     */
    public function getSeoDescription(): string
    {
        // Приоритет: Аннотация -> Описание -> "Архив трудов"
        $text = $this->annotation ?: $this->description ?: 'Архив трудов и исследований Dandaron Tradition.';

        // Очистка от HTML-тегов, декодирование сущностей (например, &mdash;) и удаление лишних пробелов
        $clean = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($text))));

        // Обрезаем до 155-160 символов для идеального отображения в поиске
        return Str::limit($clean, 155);
    }
}
