<div>
<input type="text" wire:model.debounce.1000ms="queryTerm" wire:onChange('search') placeholder="Search...">

 @if($results!=null)
    <ul>
        @foreach($results as $result)
        @endforeach
    </ul>
@endif
</div>
