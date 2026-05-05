<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Book;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $chapters = Chapter::select('id', 'slug', 'updated_at')
            ->get()
            ->unique('slug') 
            ->sortByDesc('updated_at'); 

        return response()->view('sitemap', [
            'chapters' => $chapters,
        ])->header('Content-Type', 'text/xml');
    }
}