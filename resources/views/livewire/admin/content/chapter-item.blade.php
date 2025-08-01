<li class="border rounded-md">
    <div class="flex justify-between items-center p-3">
        <div class="flex items-center">
            @if ($chapter->children->isNotEmpty())
                <button wire:click="$toggle('open')" class="mr-2 text-gray-500 hover:text-gray-800">
                    <svg class="h-4 w-4 transform transition-transform @if($open) rotate-90 @endif" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </button>
            @else
                <div class="w-6 mr-2"></div>
            @endif
            <span class="font-semibold">{{ $chapter->title }}</span>
        </div>
        <div class="space-x-2 text-sm">
            <button wire:click="createChildChapter" class="text-green-600 hover:text-green-900">Добавить под-главу</button>
            <button wire:click="editChapter" class="text-indigo-600 hover:text-indigo-900">Редакт.</button>
            <button wire:click="deleteChapter" wire:confirm="Вы уверены?" class="text-red-600 hover:text-red-900">Удалить</button>
        </div>
    </div>
    @if ($chapter->children->isNotEmpty() && $open)
        <div class="pl-6 border-t">
            <ul class="py-2 space-y-2">
                @foreach ($chapter->children as $child)
                    <livewire:admin.content.chapter-item :chapter="$child" :key="'sub-chapter-'.$child->id" />
                @endforeach
            </ul>
        </div>
    @endif
</li>
