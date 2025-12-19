<li class="text-lg">
    <a href="#chapter-{{ $chapter->slug }}"
       @click.prevent="document.querySelector('#chapter-{{ $chapter->slug }}').scrollIntoView
           ({ behavior: 'smooth' }); tocOpen = false;"
       class="flex items-start gap-2 py-1 hover:text-amber-600 transition-colors group">

        {{-- Иконка для пункта меню --}}
        @if($chapter->children->isNotEmpty())
            {{-- Иконка папки для разделов с подразделами --}}
            <svg class="w-5 h-5 flex-shrink-0 text-sky-600 group-hover:text-amber-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
            </svg>
        @else
            {{-- Иконка документа для обычных разделов --}}
            <svg class="w-5 h-5 flex-shrink-0 text-sky-600 group-hover:text-amber-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        @endif

        <span class="flex-1">{{ $chapter->title }}</span>
    </a>
    @if($chapter->children->isNotEmpty())
        <ul class="pl-4 mt-1 space-y-1">
            @foreach($chapter->children as $child)
                @include('pages.partials.toc-item', ['chapter' => $child])
            @endforeach
        </ul>
    @endif
</li>

