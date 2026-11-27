<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use LogicException;

class Placement extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'full_slug',
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
        'parent_id' => 'integer',
        'show_in_menu' => 'boolean',
        'show_on_main' => 'boolean',
        'is_protected' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (Placement $placement) {
            $placement->updateFullSlug();
        });

        static::saved(function (Placement $placement) {
            // У только что созданного раздела потомков нет.
            if (
                ! $placement->wasRecentlyCreated
                && $placement->wasChanged(['slug', 'parent_id'])
            ) {
                $placement->updateDescendantsFullSlugs();
            }

            DB::afterCommit(function () {
                static::flushMenuCache();
            });
        });

        static::deleted(function () {
            DB::afterCommit(function () {
                static::flushMenuCache();
            });
        });
    }

    /**
     * Формирование полного адреса раздела.
     */
    protected function updateFullSlug(): void
    {
        // Пересчёт нужен при создании и при изменении slug или родителя.
        // Прочие сохранения (например, смена порядка) его не затрагивают.
        if (
            $this->exists
            && $this->full_slug !== null
            && ! $this->isDirty(['slug', 'parent_id'])
        ) {
            return;
        }

        $currentSlug = trim($this->slug ?? '');

        if ($currentSlug === '') {
            throw ValidationException::withMessages([
                'slug' => 'Адрес раздела не может быть пустым.',
            ]);
        }

        // Специальный раздел home разрешён только на корневом уровне.
        if ($currentSlug === 'home') {
            if ($this->parent_id !== null) {
                throw ValidationException::withMessages([
                    'parent_id' => 'Раздел home может находиться только в корне дерева.',
                ]);
            }

            $this->full_slug = '';
            $this->assertFullSlugUnique('');

            return;
        }

        $visited = $this->exists ? [$this->id => true] : [];
        $parentId = $this->parent_id;
        $parentFullSlug = null; // берётся только у непосредственного родителя

        // Цикл проходит всю цепочку предков, чтобы обнаружить циклы,
        // но адрес берётся только у ближайшего родителя.
        while ($parentId !== null) {
            if (isset($visited[$parentId])) {
                throw ValidationException::withMessages([
                    'parent_id' => 'Обнаружена циклическая зависимость в дереве разделов.',
                ]);
            }

            $visited[$parentId] = true;

            $parent = static::query()
                ->select(['id', 'parent_id', 'slug', 'full_slug'])
                ->find($parentId);

            if (! $parent) {
                throw new LogicException(
                    "Нарушение ссылочной целостности: родитель с ID {$parentId} не найден."
                );
            }

            if ($parentFullSlug === null) {
                $parentFullSlug = trim($parent->full_slug ?? '');
            }

            if (trim($parent->slug ?? '') === 'home' && $parent->parent_id !== null) {
                throw new LogicException('Раздел home обнаружен не на корневом уровне.');
            }

            $parentId = $parent->parent_id;
        }

        $this->full_slug = $this->composeFullSlug($parentFullSlug ?? '');

        $this->assertFullSlugUnique($this->full_slug);
    }

    /**
     * Составление полного адреса из адреса родителя и собственного slug.
     * Проверка длины здесь применяется и к самому разделу, и ко всем потомкам.
     */
    protected function composeFullSlug(string $parentFullSlug): string
    {
        $slug = trim($this->slug ?? '');

        if ($slug === '' || $slug === 'home') {
            throw ValidationException::withMessages([
                'slug' => 'Недопустимый адрес подраздела.',
            ]);
        }

        $fullSlug = trim($parentFullSlug . '/' . $slug, '/');

        if (mb_strlen($fullSlug) > 255) {
            throw ValidationException::withMessages([
                'slug' => 'Полный адрес раздела слишком длинный (максимум 255 символов).',
            ]);
        }

        return $fullSlug;
    }

    /**
     * Проверка уникальности полного адреса на уровне приложения.
     * Окончательную защиту от гонок даёт уникальный индекс full_slug в БД.
     */
    protected function assertFullSlugUnique(string $fullSlug): void
    {
        $query = static::query()->where('full_slug', $fullSlug);

        if ($this->exists) {
            $query->where('id', '!=', $this->id);
        }

        if ($query->exists()) {
            throw ValidationException::withMessages([
                'slug' => 'Такой полный адрес уже используется другим разделом.',
            ]);
        }
    }

    /**
     * Пересчёт адресов всех потомков (сверху вниз).
     */
    protected function updateDescendantsFullSlugs(): void
    {
        $visited = [$this->id => true];

        $this->updateDescendantsFullSlugsRecursive($visited);
    }

    protected function updateDescendantsFullSlugsRecursive(array &$visited): void
    {
        foreach ($this->children()->get() as $child) {
            if (isset($visited[$child->id])) {
                throw ValidationException::withMessages([
                    'parent_id' => 'Обнаружена циклическая зависимость при пересчёте адресов.',
                ]);
            }

            $visited[$child->id] = true;

            $child->full_slug = $child->composeFullSlug((string) $this->full_slug);

            if ($child->isDirty('full_slug')) {
                $child->assertFullSlugUnique($child->full_slug);
                $child->saveQuietly();
            }

            $child->updateDescendantsFullSlugsRecursive($visited);
        }
    }

    /**
     * Является ли текущий раздел потомком указанного.
     */
    public function isDescendantOf(Placement $placement): bool
    {
        $visited = [];
        $parentId = $this->parent_id;

        while ($parentId !== null) {
            if ((int) $parentId === (int) $placement->id) {
                return true;
            }

            if (isset($visited[$parentId])) {
                return true;
            }

            $visited[$parentId] = true;

            $parentId = static::query()
                ->whereKey($parentId)
                ->value('parent_id');
        }

        return false;
    }

    /**
     * Все предки раздела: от корня к ближайшему родителю.
     */
    public function getAncestors(): Collection
    {
        $ancestors = collect();
        $visited = [$this->id => true];
        $parentId = $this->parent_id;

        while ($parentId !== null) {
            if (isset($visited[$parentId])) {
                throw new LogicException('Обнаружен цикл в цепочке родителей Placement.');
            }

            $visited[$parentId] = true;

            $parent = static::query()->find($parentId);

            if (! $parent) {
                throw new LogicException("Родитель раздела с ID {$parentId} не найден.");
            }

            $ancestors->push($parent);
            $parentId = $parent->parent_id;
        }

        return $ancestors->reverse()->values();
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

    /**
     * Рекурсивная загрузка дерева.
     * Предполагает целостность дерева: при циклах в данных
     * встроенной защиты от бесконечного обхода нет.
     */
    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    public function placementable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function flushMenuCache(): void
    {
        foreach ([
            'menu_tree',
            'menu_tree_optimized',
            'placement_slugs_map',
        ] as $key) {
            Cache::forget($key);
        }
    }
}
