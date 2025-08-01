<li class="text-lg">
    <a href="{{ route('chapters.show', ['chapter' => $chapter->slug]) }}" class="block hover:text-amber-600" wire:navigate>{{ $chapter->title }}</a>

    @if($chapter->children->isNotEmpty())
        <ul class="pl-4 mt-1 space-y-1">
            @foreach($chapter->children as $child)
                @include('pages.partials.toc-item', ['chapter' => $child])
            @endforeach
        </ul>
    @endif
</li>
