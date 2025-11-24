<?php

use App\Models\Placement;
use Illuminate\Support\Facades\Route;

Route::get('/menu/children/{id}', function ($id) {
    if ((int)$id === 0) {
        $items = Placement::whereNull('parent_id')
            ->orderBy('order_column')
            ->get();
    } else {
        $items = Placement::where('parent_id', $id)
            ->orderBy('order_column')
            ->get();
    }

    return $items->map(fn ($p) => [
        'id' => $p->id,
        'title' => $p->title,
        'full_slug' => $p->full_slug,
        'hasChildren' => $p->children()->exists(),
    ]);
});
