<x-layout :content="$placement">
    @section('title', $placement->title)
    <div class="prose prose-lg max-w-none mb-12">
        <h1 class="text-center">{{ $placement->title }}</h1>
    </div>
    @if($subSections->isNotEmpty())
        <div class="centered-grid">
            @foreach($subSections as $subSection)
                <div class="w-72">
                    <x-content-card :item="$subSection" />
                </div>
            @endforeach
        </div>
    @endif
</x-layout>





