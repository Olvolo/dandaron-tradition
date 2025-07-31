<?php

use App\Http\Controllers\PageController;
use App\Livewire\Admin\Authors\ManageAuthors;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Structure\ManagePlacements;
use App\Livewire\Admin\Taxonomy\ManageTaxonomy;
use App\Livewire\Admin\Content\ManageArticles;
use App\Livewire\Admin\Content\ManageBooks;
use App\Livewire\Admin\Content\BookEdit;
use Illuminate\Support\Facades\Route;

// Роут для главной страницы. Он будет вызывать тот же метод, что и остальные,
// но мы явно указываем, что ищем слаг 'home'.
Route::get('/', [PageController::class, 'show'])->name('home');

// Роуты Админки
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/authors', ManageAuthors::class)->name('authors.index');
    Route::get('/taxonomy', ManageTaxonomy::class)->name('taxonomy.index');
    Route::get('/structure', ManagePlacements::class)->name('structure.index');
    Route::get('/articles', ManageArticles::class)->name('articles.index');
    Route::get('/books', ManageBooks::class)->name('books.index');
    Route::get('/books/{book}/edit', BookEdit::class)->name('books.edit');
});

// "Всеядный" роут для всех остальных публичных страниц.
// Он должен быть САМЫМ ПОСЛЕДНИМ в файле!
Route::get('/{slug}', [PageController::class, 'show'])->where('slug', '.*')->name('page.show');
