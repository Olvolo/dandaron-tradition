<x-layout :content="$content">
    <div class="container mx-auto py-8">

        @if($featured->isNotEmpty())
            <h2 class="text-3xl text-center text-main-page font-bold mt-8">
                Духовным подвижникам посвящается</h2>
            <div class="grid md:grid-cols-3 gap-6 mt-16">
                @foreach($featured as $item)
                    <x-content-card :item="$item" />
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
