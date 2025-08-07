@php
    $padding = ($level ?? 0) * 2;
    $headingLevel = 2 + ($level ?? 0);
@endphp

<div style="padding-left: {{ $padding }}rem;" class="mt-8 scroll-mt-20">
    {!! "<h".$headingLevel." id=\"chapter-$chapter->slug\" class=\"text-2xl font-bold mb-4 text-center\">" !!}    {{ $chapter->title }}
    {!! "</h".$headingLevel.">" !!}

    <div class="prose prose-lg max-w-none">
        {!! $chapter->content_html !!}
    </div>
</div>

@if($chapter->children->isNotEmpty())
    @foreach($chapter->children as $child)
        @include('pages.partials.chapter-content', ['chapter' => $child, 'level' => ($level ?? 0) + 1])
    @endforeach
@endif
