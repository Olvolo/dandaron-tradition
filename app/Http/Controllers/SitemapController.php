<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Placement;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        // Главы
        $chapters = Chapter::select('id', 'slug', 'book_id', 'updated_at')
            ->with(['book' => function ($query) {
                $query->select('id', 'is_protected')->with('placement:id,placementable_id,placementable_type,full_slug');
            }])
            ->get()
            ->filter(fn($chapter) => $chapter->book && !$chapter->book->is_protected && $chapter->book->placement)
            ->sortByDesc('updated_at');

        // Статьи
        $articles = Article::whereNull('parent_id')
            ->select('id', 'updated_at')
            ->with('placement')
            ->get()
            ->filter(fn($article) => $article->placement && !$article->is_protected)
            ->sortByDesc('updated_at');

        // Книги
        $books = Book::select('id', 'updated_at')
            ->with('placement')
            ->get()
            ->filter(fn($book) => $book->placement && !$book->is_protected)
            ->sortByDesc('updated_at');

        // Разделы (Placement без placementable)
        $sections = Placement::whereNull('placementable_type')
            ->where('full_slug', '!=', '')
            ->select('id', 'full_slug', 'updated_at')
            ->get()
            ->sortByDesc('updated_at');

        return response()->view('sitemap', [
            'chapters' => $chapters,
            'articles' => $articles,
            'books' => $books,
            'sections' => $sections,
        ])->header('Content-Type', 'text/xml');
    }
}
