<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug']; // <-- Добавьте это
}
