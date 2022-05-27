<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div>
        <input wire:model.debouce.500ms="search" type="search" class="form-control">
    </div>
    <div>
        <ul class="list-group">
        @foreach($searchResults as $searchResult)
                <li class="list-group-item"><a wire:click="$set('search', $searchResult->name)" href="#">{{$searchResult->name}}</a></li>
        @endforeach
        </ul>
    </div>
</div>
