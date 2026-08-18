@php
    $newsPlacement = \App\Models\Placement::where('slug', 'novosti-sajta')
        ->with('placementable')
        ->first();

    $newsArticle = $newsPlacement?->placementable instanceof \App\Models\Article
        ? $newsPlacement->placementable
        : null;

    $latestItems = collect();

    if ($newsArticle && !empty($newsArticle->content_html)) {
        // Достаём текст первых 2 пунктов <li> из content_html статьи.
        preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $newsArticle->content_html, $matches);

        if (!empty($matches[1])) {
            $latestItems = collect($matches[1])
                ->take(2)
                ->map(fn($item) => trim(strip_tags($item)));
        }
    }
@endphp

@if($newsArticle && $latestItems->isNotEmpty())
    <a href="{{ url($newsPlacement->full_slug) }}"
       class="block bg-white/80 backdrop-blur-sm rounded-xl p-3 border border-sky-200/40 hover:border-amber-400 transition-colors group mb-4">
        <h4 class="text-sm font-bold text-sky-900 mb-2 flex items-center gap-1">
            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Новости сайта
        </h4>
        <ul class="space-y-1.5">
            @foreach($latestItems as $item)
                <li class="text-xs text-sky-800 group-hover:text-amber-700 transition-colors line-clamp-2">
                    {{ $item }}
                </li>
            @endforeach
        </ul>
    </a>
@endif
