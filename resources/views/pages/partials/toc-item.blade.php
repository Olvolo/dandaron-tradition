@php
    /** @var \App\Models\Chapter $chapter */
    /** @var int $level */

    $level = $level ?? 0;

    $icons = [
        0 => ['path' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'color' => 'text-blue-700'],
        1 => ['path' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z', 'color' => 'text-orange-600'],
        2 => ['path' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'text-emerald-600'],
        3 => ['path' => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z', 'color' => 'text-purple-600'],
        4 => ['path' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'text-rose-600'],
        5 => ['path' => 'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z', 'color' => 'text-teal-600'],
        6 => ['path' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'color' => 'text-amber-600'],
        7 => ['path' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'color' => 'text-indigo-600'],
    ];

    $currentIcon = $icons[$level % 8];

    $iconSizes = ['w-4 h-4', 'w-4 h-4', 'w-3.5 h-3.5', 'w-3.5 h-3.5', 'w-3 h-3', 'w-3 h-3', 'w-3 h-3', 'w-3 h-3'];
    $iconSize = $iconSizes[min($level, 7)];

    $hasChildren = $chapter->children->isNotEmpty();
@endphp

{{-- <li class="text-sm text-black" x-data="{ open: $persist(true).as('toc-{{ $chapter->slug }}') }"> --}}
    <li class="text-sm text-black" 
    x-data="{ open: $persist(true).as('toc-{{ $chapter->slug }}') }"
    @toc-control.window="open = $event.detail.open">
    <div class="flex items-start gap-1 py-1 group">
        @if($hasChildren)
            <button @click="open = !open" class="flex-shrink-0 w-4 h-4 mt-0.5 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        @else
            <span class="w-4 h-4"></span>
        @endif

        <a href="#chapter-{{ $chapter->slug }}"
           @click.prevent="document.querySelector('#chapter-{{ $chapter->slug }}').scrollIntoView
               ({ behavior: 'smooth' }); tocOpen = false;"
           class="flex items-start gap-1 flex-1 hover:text-amber-600 transition-colors">

            <svg class="{{ $iconSize }} flex-shrink-0 {{ $currentIcon['color'] }} group-hover:text-amber-600 mt-0.5"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $currentIcon['path'] }}"/>
            </svg>

            <span class="flex-1">{{ $chapter->title }}</span>
        </a>
    </div>

    @if($hasChildren)
        <ul x-show="open" x-collapse class="pl-4 mt-1 space-y-1">
            @foreach($chapter->children as $child)
                @include('pages.partials.toc-item', ['chapter' => $child, 'level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>
