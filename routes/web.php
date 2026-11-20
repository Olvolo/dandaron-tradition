<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Livewire\Admin\Authors\ManageAuthors;
use App\Livewire\Admin\Content\BookEdit;
use App\Livewire\Admin\Content\ManageArticles;
use App\Livewire\Admin\Content\ManageBooks;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Structure\ManagePlacements;
use App\Livewire\Admin\Taxonomy\ManageTaxonomy;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SandboxController;
use App\Http\Controllers\SitemapController;


// --- Публичные маршруты ---
Route::get('/', function (\Illuminate\Http\Request $request) {
    if (str_contains($request->header('Accept', ''), 'text/markdown')) {
        $markdown = <<<'MD'
# Dandaron Tradition

Онлайн-архив трудов и материалов, посвящённых Бидии Дандаровичу Дандарону, его учителю Лубсану Сандану Цыденову и традиции «необуддизма».

Полный каталог материалов, сутр и книг доступен по адресу: https://dandaron-tradition.com/llms.txt
MD;

        return response($markdown, 200)
            ->header('Content-Type', 'text/markdown; charset=UTF-8')
            ->header('Vary', 'Accept');
    }

    return app(PageController::class)->home($request);
})->name('home');
Route::get('/search', SearchController::class)->name('search');

// --- Маршруты аутентификации (Breeze) ---
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Маршруты Админ-панели ---
Route::prefix('admin')->name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/authors', ManageAuthors::class)->name('authors.index');
        Route::get('/taxonomy', ManageTaxonomy::class)->name('taxonomy.index');
        Route::get('/structure', ManagePlacements::class)->name('structure.index');
        Route::get('/articles', ManageArticles::class)->name('articles.index');
        Route::get('/books', ManageBooks::class)->name('books.index');
        Route::get('/books/{book}/edit', BookEdit::class)->name('books.edit');
        Route::get('/sandbox/html-preview', [SandboxController::class, 'htmlPreview'])->name('sandbox.html');
    });

// Подключение маршрутов входа/регистрации/выхода
require __DIR__ . '/auth.php';

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// "Всеядный" маршрут для публичных страниц (ОБЯЗАТЕЛЬНО ПОСЛЕДНИЙ!)
Route::get('/{slug}', [PageController::class, 'show'])->where('slug', '.*')->name('page.show');
