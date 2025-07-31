<li class="border rounded-md" wire:key="{{ $item->id }}">
    <div x-data="{ open: true }">
        <div class="flex justify-between items-center p-3">
            <div class="flex items-center">
                @if ($item->children->isNotEmpty())
                    <button @click="open = !open" class="mr-2 text-gray-500 hover:text-gray-800">
                        <svg class="h-4 w-4 transform transition-transform" :class="{ 'rotate-90': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                @else
                    <div class="w-6 mr-2"></div>
                @endif
                <span class="font-semibold">{{ $item->title }}</span>
            </div>

            <div class="space-x-2 text-sm">
                <button wire:click="create({{ $item->id }})" class="text-green-600 hover:text-green-900">Добавить</button>
                <button wire:click="edit({{ $item->id }})" class="text-indigo-600 hover:text-indigo-900">Редакт.</button>
                <button wire:click="delete({{ $item->id }})" wire:confirm="Вы уверены? Все дочерние элементы также будут удалены!" class="text-red-600 hover:text-red-900">Удалить</button>
            </div>
        </div>

        @if ($item->children->isNotEmpty())
            <div x-show="open" class="pl-6 border-t">
                <ul class="py-2 space-y-2">
                    @foreach ($item->children as $child)
                        @include('livewire.admin.structure.placement-item', ['item' => $child])
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</li>
