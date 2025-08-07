<li class="text-lg">
    <a href="#chapter-{{ $chapter->slug }}"
           @click.prevent="document.querySelector('#chapter-{{ $chapter->slug }}').scrollIntoView
           ({ behavior: 'smooth' }); tocOpen = false;"
       class="block hover:text-amber-600">
        {{ $chapter->title }}
    </a>
    @if($chapter->children->isNotEmpty())
        <ul class="pl-4 mt-1 space-y-1">
            @foreach($chapter->children as $child)
                @include('pages.partials.toc-item', ['chapter' => $child])
            @endforeach
        </ul>
    @endif
</li>
