@props(['item'])

<a href="{{ url($item->full_slug) }}" class="block border rounded-lg overflow-hidden hover:shadow-md transition">
    <div class="p-4">
        <h3 class="font-bold text-lg">{{ $item->title }}</h3>
        <p class="text-gray-600 text-sm mt-1">{{ $item->placementable_type }}</p>
    </div>
</a>
