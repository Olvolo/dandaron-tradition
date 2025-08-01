{{-- Этот шаблон будет отвечать за один пункт меню и его дочерние элементы --}}
<li class="relative group">
    <a href="{{ url($item->full_slug) }}" class="hover:text-amber-600" wire:navigate>{{ $item->title }}</a>

    {{-- Если есть дочерние элементы, создаём вложенный список --}}
    @if($item->childrenRecursive->isNotEmpty())
        <ul class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2 invisible group-hover:visible transition-all duration-200">
            @foreach($item->childrenRecursive as $child)
                {{-- И для каждого дочернего элемента снова вызываем этот же шаблон --}}
                @include('layouts.partials.nav-item', ['item' => $child])
            @endforeach
        </ul>
    @endif
</li>
