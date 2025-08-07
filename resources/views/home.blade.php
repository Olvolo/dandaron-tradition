<x-layout>
    <div class="container mx-auto py-8">

        @if($featured->isNotEmpty())
            <h2 class="text-2xl font-semibold mb-4">Рекомендуем</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($featured as $item)
                    <x-content-card :item="$item" />
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
