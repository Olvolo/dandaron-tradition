<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Placement extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'full_slug', // ДОБАВЛЯЕМ в fillable!
        'placementable_type',
        'placementable_id',
        'order_column',
        'show_in_menu',
        'show_on_main',
        'is_protected',
        'background_image_url',
        'custom_styles',
    ];

    protected $casts = [
        'show_in_menu' => 'boolean',
        'show_on_main' => 'boolean',
        'is_protected' => 'boolean',
    ];

    protected static function booted()
    {
        // При сохранении пересчитываем full_slug
        static::saving(function ($placement) {
            $placement->updateFullSlug();
        });

        // После сохранения обновляем потомков
        static::saved(function ($placement) {
            $placement->updateDescendantsFullSlugs();
            Cache::forget('menu_tree');
            Cache::forget('menu_tree_optimized');
            Cache::forget('placement_slugs_map');
        });

        static::deleted(function () {
            Cache::forget('menu_tree');
            Cache::forget('menu_tree_optimized');
            Cache::forget('placement_slugs_map');
        });
    }

    /**
     * Обновляем full_slug ПЕРЕД сохранением
     */
    protected function updateFullSlug(): void
    {
        if ($this->slug === 'home') {
            $this->full_slug = '';
            return;
        }

        $parts = [];
        $current = $this;

        // Собираем slugs до корня
        while ($current !== null && $current->slug !== null) {
            if ($current->slug !== 'home') {
                array_unshift($parts, $current->slug);
            }

            // Если parent_id изменился, загружаем нового родителя
            if ($current->isDirty('parent_id') && $current->parent_id) {
                $current = self::find($current->parent_id);
            } else {
                $current = $current->parent;
            }
        }

        $this->full_slug = implode('/', $parts);
    }

    /**
     * Обновляем full_slug у всех потомков (рекурсивно)
     */
    protected function updateDescendantsFullSlugs(): void
    {
        $children = $this->children()->get();

        foreach ($children as $child) {
            $child->updateFullSlug();
            $child->saveQuietly(); // Сохраняем без триггера событий
            $child->updateDescendantsFullSlugs();
        }
    }

    /**
     * Быстрый поиск по full_slug через индекс БД
     */
    public static function findByFullSlug(string $slug): ?self
    {
        return self::where('full_slug', $slug)->first();
    }

    /**
     * Метод для ручного сброса кеша
     */
    public static function clearMenuCache(): void
    {
        Cache::forget('menu_tree');
        Cache::forget('placement_slugs_map');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Placement::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Placement::class, 'parent_id')
            ->orderBy('order_column');
    }

    public function placementable(): MorphTo
    {
        return $this->morphTo();
    }

    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    /**
     * Список всех предков (с кешированием запроса)
     */
    public function getAncestors(): Collection
    {
        if (!$this->parent_id) {
            return collect();
        }

        // Загружаем всю цепочку родителей одним запросом
        $ancestors = collect();
        $parentIds = [];
        $current = $this;

        // Собираем все parent_id
        while ($current->parent_id) {
            $parentIds[] = $current->parent_id;
            $current = $current->parent;
        }

        if (empty($parentIds)) {
            return collect();
        }

        // Загружаем всех родителей одним запросом
        $parents = self::whereIn('id', $parentIds)->get()->keyBy('id');

        // Восстанавливаем порядок
        $current = $this;
        while ($current->parent_id && isset($parents[$current->parent_id])) {
            $ancestors->push($parents[$current->parent_id]);
            $current = $parents[$current->parent_id];
        }

        return $ancestors;
    }

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
}
