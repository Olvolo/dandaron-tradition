<li class="border rounded-md">
    <div>
        <div class="flex justify-between items-center p-3">
            <div class="flex items-center">
                @if ($placement->children->isNotEmpty())
                    <button wire:click="$toggle('open')" class="mr-2 text-sky-600 hover:text-sky-900">
                        <svg class="h-4 w-4 transform transition-transform" @if($open) style="transform: rotate(90deg);" @endif fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                @else
                    <div class="w-6 mr-2"></div>
                @endif
                <div>
                    <span class="font-semibold">{{ $placement->title }}</span>
                    <span class="ml-2 text-sm text-sky-600 font-mono">/{{ $placement->slug }}</span>
                </div>
            </div>
            <div class="space-x-2 text-sm">
                <button wire:click="createChildPlacement" class="text-green-600 hover:text-green-900">Добавить</button>
                <button wire:click="editPlacement" class="text-indigo-600 hover:text-indigo-900">Редакт.</button>
                <button wire:click="deletePlacement" wire:confirm="Вы уверены?" class="text-red-600 hover:text-red-900">Удалить</button>
            </div>
        </div>
        @if ($placement->children->isNotEmpty() && $open)
            <div class="pl-6 border-t">
                <ul class="py-2 space-y-2">
                    @foreach ($placement->children as $child)
                        <livewire:admin.structure.placement-item :placement="$child" :key="'sub-placement-'.$child->id" />
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</li>
