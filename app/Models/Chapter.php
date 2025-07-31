<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'parent_id',
        'order_column',
        'title',
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
}
