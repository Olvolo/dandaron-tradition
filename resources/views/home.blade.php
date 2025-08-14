<x-layout :content="$content">
    <div class="container mx-auto py-8">

        @if($featured->isNotEmpty())
            <h2 class="text-3xl text-center text-main-page font-bold mt-8 mb-12 italic">
                Духовным подвижникам посвящается</h2>
            <div class="flex justify-center">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featured as $item)
                        <div class="w-72">
                            <x-content-card :item="$item"/>
                        </div>
                    @endforeach
                </div>
            </div>
    @endif
</x-layout>
