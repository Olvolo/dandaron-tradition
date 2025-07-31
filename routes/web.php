<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ChapterController;
use App\Livewire\Admin\Authors\ManageAuthors;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Structure\ManagePlacements;
use App\Livewire\Admin\Taxonomy\ManageTaxonomy;
use App\Livewire\Admin\Content\ManageArticles;
use App\Livewire\Admin\Content\ManageBooks;
use App\Livewire\Admin\Content\BookEdit;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Публичные маршруты
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'show'])->name('home');
Route::get('/chapters/{chapter:slug}', [ChapterController::class, 'show'])->name('chapters.show');


/*
|--------------------------------------------------------------------------
| Маршруты Админ-панели
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/authors', ManageAuthors::class)->name('authors.index');
    Route::get('/taxonomy', ManageTaxonomy::class)->name('taxonomy.index');
    Route::get('/structure', ManagePlacements::class)->name('structure.index');
    Route::get('/articles', ManageArticles::class)->name('articles.index');
    Route::get('/books', ManageBooks::class)->name('books.index');
    Route::get('/books/{book}/edit', BookEdit::class)->name('books.edit');
});

/*
|--------------------------------------------------------------------------
| "Всеядный" маршрут (всегда должен быть последним!)
|--------------------------------------------------------------------------
*/
Route::get('/{slug}', [PageController::class, 'show'])->where('slug', '.*')->name('page.show');
