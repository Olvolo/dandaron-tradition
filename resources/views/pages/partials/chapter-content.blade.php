@php
    $headingLevel = 2 + ($level ?? 0);
    $headingTag = min(6, $headingLevel);

    $headingAttributes = 'id="' . e('chapter-' . $chapter->slug) . '"'
        . ' data-chapter-url="' . e($chapter->getUrl()) . '"'
        . ' class="text-2xl font-bold mb-8 text-center group"';
@endphp

<div class="mt-8 scroll-mt-20">

    @if($headingLevel <= 6)
        {!! '<h' . $headingTag . ' ' . $headingAttributes . '>' !!}
    @else
        {!! '<div role="heading" aria-level="' . $headingLevel . '" ' . $headingAttributes . '>' !!}
    @endif

        {{ $chapter->title }}

        <a href="{{ $chapter->getUrl() }}"
           @click.prevent="history.pushState(null, '', '{{ $chapter->getUrl() }}')"
           class="ml-2 text-sky-400 opacity-0 group-hover:opacity-100 text-base align-middle no-underline"
           title="Постоянная ссылка на главу">#</a>

    @if($headingLevel <= 6)
        </h{{ $headingTag }}>
    @else
        </div>
    @endif

    <div class="prose prose-lg max-w-none">
        {!! $chapter->getContentWithAbsoluteAnchors() !!}
    </div>
</div>

@if($chapter->children->isNotEmpty())
    @foreach($chapter->children as $child)
        @include('pages.partials.chapter-content', [
            'chapter' => $child,
            'level' => ($level ?? 0) + 1
        ])
    @endforeach
@endif
