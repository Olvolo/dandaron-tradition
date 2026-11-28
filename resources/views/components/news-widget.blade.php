
@php
    $news = cache()->remember('news_widget', 600, function () {
        $placement = \App\Models\Placement::where('slug', 'novosti-sajta')
            ->with('placementable')
            ->first();

        $article = $placement?->placementable instanceof \App\Models\Article
            ? $placement->placementable
            : null;

        if (!$article || blank($article->content_html)) {
            return [];
        }

        preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $article->content_html, $matches);

        $items = collect($matches[1] ?? [])
            ->take(2)
            ->map(fn ($item) => trim(preg_replace(
                '/\s+/u',
                ' ',
                html_entity_decode(
                    strip_tags($item),
                    ENT_QUOTES | ENT_HTML5,
                    'UTF-8'
                )
            )))
            ->filter()
            ->values()
            ->all();

        return $items === [] ? [] : [
            'url' => url($placement->full_slug),
            'items' => $items,
        ];
    });
@endphp

@if(!empty($news))
    <a href="{{ $news['url'] }}"
       class="block bg-white/80 backdrop-blur-sm rounded-xl p-3 border border-sky-200/40 hover:border-amber-400 transition-colors group mb-4">
        <h4 class="text-sm font-bold text-sky-900 mb-2 flex items-center gap-1">
            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Новости сайта
        </h4>
        <ul class="space-y-1.5">
            @foreach($news['items'] as $item)
                <li class="text-xs text-sky-800 group-hover:text-amber-700 transition-colors line-clamp-2">
                    {{ $item }}
                </li>
            @endforeach
        </ul>
    </a>
@endif
