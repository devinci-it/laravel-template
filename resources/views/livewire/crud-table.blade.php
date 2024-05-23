<div class="table-container p3 m2">
    <!-- Button to create a new record -->
    <button wire:click="createRecord" class="btn">Create New Record</button>
    <!-- Buttons for saving or discarding changes -->
    @if($selectedRow !== null)
        <div class="mb-4">
            <button wire:click="saveRow({{ $selectedRow }})" class=" round btn btn-success">Save</button>
            <button wire:click="discardChanges" class="btn round btn-danger">Discard Changes</button>
        </div>
    @endif

</hr>

    <!-- Table to display records -->
    <table class="table minimal-table my3">
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
                            <!-- Input field for editing -->
                            <input wire:model.defer="data.{{ $index }}.{{ $column }}" type="text" class="form-control" value="{{ $record->$column }}">
                        @else
                            <!-- Displaying record data -->
                            {{ $record->$column }}
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Pagination links -->
    <div class="pagination-controls flex flex-grow-h">
        {{ $data->links() }}
    </div>


</div>
@once

@push('styles')
    <style>
        ul.pagination {
            display: flex;
            gap: 25px;
            justify-content: center;
            align-items: center;
            align-content: center;
            flex-wrap: nowrap;
        }

        .minimal-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'HubotSans', sans-serif;
        }

        /* Table Header */
        .minimal-table thead {
            background-color: #f9f9f9;
            color: #333;
            text-align: left;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .minimal-table th {
            padding: 6px;
            font-weight: bold;
            border-bottom: 2px solid #ddd; /* Subtle bottom border for headers */
        }

        /* Table Body */
        .minimal-table tbody tr {
            transition: background-color 0.3s;
        }

        .minimal-table tbody tr:nth-child(even) {
            background-color: #f9f9f9; /* Subtle stripe effect */
        }

        .minimal-table tbody tr:hover {
            background-color: #f1f1f1; /* Subtle hover effect */
        }

        .minimal-table td {
            padding: 6px;
            border-bottom: 1px solid #ddd; /* Subtle bottom border for rows */
        }

        /* Button Styles */
        .minimal-table button {
            padding: 6px 12px;
            margin-right: 5px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .minimal-table button:hover {
            background-color: #0056b3;
        }

        .minimal-table button:last-child {
            background-color: #dc3545;
        }

        .minimal-table button:last-child:hover {
            background-color: #c82333;
        }
        li.page-item.disabled,
        button.page-link{
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 5px 20px;
                font-weight: 600;
            font-size: .7rem;
                line-height: 1.5;
                color: #24292e;
                background-color: #f6f8fa;
                border: 1px solid #d1d5da;
                border-radius: 35px;
                cursor: pointer;
                transition: background-color 0.3s ease-in-out;
                text-decoration: none;
        }

        .disabled{
            opacity: 30%;
        }
        .pagination-controls>*{
            display: flex;
            justify-content: center;
            align-items: center;
            gap :10px;
        }

    </style>
@endpush
@endonce
