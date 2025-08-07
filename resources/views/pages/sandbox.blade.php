<x-layout>
    @section('title', 'HTML Песочница')

    {{-- Make the main container a flex column that fills the available height --}}
    <div x-data="{ sourceHtml: '<h1>Введите ваш HTML здесь</h1><p>И он появится справа.</p>' }" class="flex flex-col flex-grow">

        {{-- This grid will now expand to fill the container --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-grow">

            {{-- Left panel: flex column to make textarea fill height --}}
            <div class="flex flex-col">
                <label for="source" class="block text-lg font-medium text-gray-700 mb-2">HTML-код</label>
                <textarea
                    id="source"
                    x-model="sourceHtml"
                    class="w-full h-full flex-grow p-4 border-gray-300 rounded-md shadow-sm font-mono text-sm focus:ring-sky-500 focus:border-sky-500"
                ></textarea>
            </div>

            {{-- Right panel: flex column to make preview fill height --}}
            <div class="flex flex-col">
                <label class="block text-lg font-medium text-gray-700 mb-2">Предпросмотр</label>
                <div class="w-full h-full p-8 bg-white/80 rounded-lg shadow-inner overflow-y-auto">
                    <div class="prose prose-lg max-w-none" x-html="sourceHtml"></div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
