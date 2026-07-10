{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Главная страница --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toIso8601String() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- Книги (высокий приоритет) --}}
    @foreach($books as $book)
        <url>
            <loc>{{ $book->getUrl() }}</loc>
            <lastmod>{{ $book->updated_at->tz('UTC')->toIso8601String() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach

    {{-- Статьи (высокий приоритет) --}}
    @foreach($articles as $article)
        <url>
            <loc>{{ $article->getUrl() }}</loc>
            <lastmod>{{ $article->updated_at->tz('UTC')->toIso8601String() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Главы (средний приоритет) --}}
    @foreach($chapters as $chapter)
        <url>
            <loc>{{ $chapter->getUrl() }}</loc>
            <lastmod>{{ $chapter->updated_at->tz('UTC')->toIso8601String() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    {{-- Разделы (низкий приоритет) --}}
    @foreach($sections as $section)
        <url>
            <loc>{{ url($section->full_slug) }}</loc>
            <lastmod>{{ $section->updated_at->tz('UTC')->toIso8601String() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>
