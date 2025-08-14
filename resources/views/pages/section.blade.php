<x-layout :content="$placement">
    @section('title', $placement->title)

    <div class="prose prose-lg max-w-none mb-12">
        <h1 class="text-center">{{ $placement->title }}</h1>
    </div>

    @if($subSections->isNotEmpty())
        {{-- This wrapper will center the grid block --}}
        <div class="flex justify-center">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($subSections as $subSection)
                    <div class="w-72">
                        <x-content-card :item="$subSection" />
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-layout>
