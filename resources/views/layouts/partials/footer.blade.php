<footer class="bg-white shadow-inner mt-8">
    <div class="container mx-auto p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="font-bold text-lg mb-2">Dandaron Tradition</h3>
                <p class="text-gray-600 text-sm">
                    Онлайн-архив статей и книг, посвящённый работам ряда авторов.
                </p>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-2">Навигация</h3>
                @if(isset($menuItems) && $menuItems->isNotEmpty())
                    <ul class="text-sm">
                        @foreach ($menuItems as $item)
                            <li>
                                <a href="/{{ $item->slug }}" class="text-gray-700 hover:text-amber-600" wire:navigate>
                                    {{ $item->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div>
                {{-- Место для дополнительной информации --}}
            </div>
        </div>
        <div class="border-t mt-8 pt-6 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} Dandaron Tradition. All rights reserved.</p>
        </div>
    </div>
</footer>
