<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Placement extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'order_column',
        'placementable_type',
        'placementable_id',
        'show_in_menu',
        'show_on_main',
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
     * ЭТОТ МЕТОД, СКОРЕЕ ВСЕГО, ОТСУТСТВОВАЛ.
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
}
