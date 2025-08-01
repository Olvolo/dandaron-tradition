<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @method static where(string $string, mixed $slug)
 */
class Placement extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'full_slug',
        'order_column',
        'placementable_type',
        'placementable_id',
        'show_in_menu',
        'show_on_main',
    ];

    /**
     * Атрибуты, которые должны быть приведены к определённым типам.
     *
     * @var array
     */
    protected $casts = [
        'show_in_menu' => 'boolean',
        'show_on_main' => 'boolean',
    ];

    /**
     * Связь с родительским элементом.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Placement::class, 'parent_id');
    }

    /**
     * Связь с дочерними элементами.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Placement::class, 'parent_id')->orderBy('order_column');
    }

    /**
     * Полиморфная связь с контентом.
     */
    public function placementable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Рекурсивная связь для загрузки всего дерева меню.
     */
    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    /**
     * Аксессор для получения полного, вложенного слага.
     * ИСПРАВЛЕННАЯ ВЕРСИЯ с лучшей обработкой edge cases.
     */
    public function getFullSlugAttribute(): string
    {
        // Используем кэширование для избежания повторных вычислений
        if (isset($this->attributes['cached_full_slug'])) {
            return $this->attributes['cached_full_slug'];
        }

        $parts = [];
        $current = $this;

        // Собираем полный путь от потомка к родителю
        while ($current !== null) {
            array_unshift($parts, $current->slug);
            $current = $current->parent;
        }

        // Обработка главной страницы
        if (count($parts) === 1 && $parts[0] === 'home') {
            $result = 'home';
        } else {
            // Убираем 'home' из публичного URL для вложенных страниц
            if (count($parts) > 1 && $parts[0] === 'home') {
                array_shift($parts);
            }
            $result = implode('/', $parts);
        }

        // Кэшируем результат
        $this->attributes['cached_full_slug'] = $result;

        return $result;
    }

    /**
     * Получить все родительские элементы до корня.
     */
    public function getAncestors()
    {
        $ancestors = collect();
        $current = $this->parent;

        while ($current !== null) {
            $ancestors->push($current);
            $current = $current->parent;
        }

        return $ancestors;
    }

    /**
     * Проверить, является ли данный элемент потомком указанного.
     */
    public function isDescendantOf(Placement $placement): bool
    {
        $current = $this->parent;

        while ($current !== null) {
            if ($current->id === $placement->id) {
                return true;
            }
            $current = $current->parent;
        }

        return false;
    }
    /**
     * Этот метод будет автоматически вызываться при сохранении модели.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Перед сохранением вычисляем и устанавливаем полный слаг
            $model->full_slug = $model->buildFullSlug();
        });
    }

    /**
     * Вычисляет полный слаг, двигаясь вверх по цепочке родителей.
     * Эта версия надежна и не зависит от порядка сохранения.
     */
    public function buildFullSlug(): string
    {
        // У главной страницы всегда пустой full_slug
        if ($this->slug === 'home') {
            return '';
        }

        $parts = [];
        $current = $this;

        while ($current !== null && $current->slug !== 'home') {
            array_unshift($parts, $current->slug);
            $current = $current->parent;
        }

        return implode('/', $parts);
    }
}
