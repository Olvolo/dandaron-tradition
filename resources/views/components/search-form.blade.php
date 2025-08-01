<form action="{{ route('search') }}" method="GET" {{ $attributes->merge(['class' => 'flex items-center space-x-2']) }}>
    <input
        type="text"
        name="q"
        value="{{ request('q') }}"
        placeholder="Поиск..."
        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-400"
    >
    <button type="submit"
            class="bg-sky-600 text-white px-4 py-2 rounded hover:bg-sky-700 transition">
        Найти
    </button>
</form>
