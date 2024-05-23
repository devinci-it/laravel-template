<!-- resources/views/livewire/search-component.blade.php -->

<div>
    <input type="text" wire:model="searchTerm" placeholder="Search..." class="form-input">

    <x-shared.search-modal name="searchResultsModal" :open="$searchTerm !== ''">
        <x-slot name="title">
            Search Results
        </x-slot>
        <ul>
            @forelse($this->results as $result)
                <li>{{ $result->name ?? 'No Name' }}</li>
            @empty
                <li>No results found.</li>
            @endforelse
        </ul>
    </x-shared.search-modal>
</div>
