<option value="{{ $placement->id }}" @if($placement->id == ($this->parent_id ?? null)) selected @endif>
    {!! str_repeat('&nbsp;&nbsp;&nbsp;', $level) !!} {{ $placement->title }}
</option>
@if($placement->children->isNotEmpty())
    @foreach($placement->children->sortBy('order_column') as $child)
        @include('livewire.admin.structure.placement-option', ['placement' => $child, 'level' => $level + 1])
    @endforeach
@endif
