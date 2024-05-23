<div>
    <!-- Button to create a new record -->
    <button wire:click="createRecord" class="btn btn-primary">Create New Record</button>

    <!-- Table to display records -->
    <table class="table">
        <!-- Table header -->
        <thead>
        <tr>
            @foreach($columns as $column)
                <th>{{ ucfirst($column) }}</th>
            @endforeach
        </tr>
        </thead>
        <!-- Table body -->
        <tbody>
        @foreach($data as $index => $record)
            <tr wire:click="selectRow({{ $index }})" class="{{ $selectedRow === $index ? 'selected' : '' }}">
                @foreach($columns as $column)
                    <td>
                        @if($selectedRow === $index)
                            @dd('record')
                            <!-- Input field for editing -->
                            <input wire:model.defer="data.{{ $index }}.{{ $column }}" type="text" class="form-control" value="{{ $record[$column] }}">
                        @else
                            <!-- Displaying record data -->
                            {{ $record[$column] }}
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Buttons for saving or discarding changes -->
    @if($selectedRow !== null)
        <div class="mb-4">
            <button wire:click="saveRow({{ $selectedRow }})" class="btn btn-success">Save</button>
            <button wire:click="discardChanges" class="btn btn-danger">Discard Changes</button>
        </div>
    @endif
</div>
