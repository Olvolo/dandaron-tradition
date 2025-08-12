@props(['item'])

<a href="{{ url($item->full_slug) }}" class="block rounded-2xl overflow-hidden glassmorphism-card group">
    <div class="p-4">
        <h3 class="font-bold text-2xl text-center text-main-page">{{ $item->title }}</h3>
        <p class="text-gray-600 text-sm mt-1">{{ $item->placementable_type }}</p>
    </div>
</a>
