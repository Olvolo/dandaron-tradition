<x-layout :content="$content">
    <div class="container mx-auto py-8">

        @if($featured->isNotEmpty())
            <h2 class="text-2xl text-main-page font-bold mb-4">Восхитительным духовным подвижникам
                посвящается</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($featured as $item)
                    <x-content-card :item="$item" />
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
