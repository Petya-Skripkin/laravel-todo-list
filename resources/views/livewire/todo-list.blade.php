<ul class="list-group w-50 mt-5 mx-auto">
    @forelse ($data as $item)
        <li class="list-group-item todo-container">
            {{-- @dd($data) --}}
            <input
                class="form-check-input input"
                type="checkbox"
                id="{{$item->title . $item->id}}"
                wire:change='checkItem({{$item->id}})'
                @if ($item->is_checked)
                checked
                @endif
            >
            <label class="form-check-label stretched-link ms-2" for="{{$item->title . $item->id}}">
                {{$item->title}}
            </label>
            <button type="button" class="btn-close ms-auto" wire:click='removeItem({{$item->id}})' aria-label="Close"></button>
        </li>
    @empty
        No data
    @endforelse
</ul>
