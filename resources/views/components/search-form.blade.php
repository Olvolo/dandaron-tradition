<form action="{{ route('search') }}" method="GET" {{ $attributes->merge(['class' => 'relative']) }}>
    <div class="relative">
        <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            placeholder="Поиск..."
            class="w-full pl-4 pr-12 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-colors"
        >
        <button type="submit"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-sky-600 text-white px-3 py-1 rounded hover:bg-sky-700 transition-colors text-sm">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>
    </div>
</form>
