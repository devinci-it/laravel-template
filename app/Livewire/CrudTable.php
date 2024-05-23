<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class CrudTable extends Component
{
    use WithPagination;

    public $columns;
    public $selectedRow = null;
    protected $paginationTheme = 'simple-bootstrap';

    public function mount($columns)
    {
        $this->columns = $columns;
    }

    public function selectRow($index)
    {
        $this->selectedRow = $index;
    }



    public function saveRow($index)
    {
        // Save changes for the specified row
        $record = $this->data[$index];
        $record->save();

        // Clear the selected row after saving
        $this->selectedRow = null;
    }

    public function discardChanges()
    {
        // Clear the selected row without saving changes
        $this->selectedRow = null;
    }

    public function fetchRecord($id)
    {
        // Fetch a record by ID
        return Product::find($id);
    }

    public function updateRecord($index)
    {
        // Update a specific record
        $record = $this->data[$index];
        $record->save();
    }

    public function createRecord()
    {
        // Create a new record
        $newRecord = new Product();
        $newRecord->save();

        // Add the new record to the data collection
        // $this->data->push($newRecord);
    }

    public function updated($propertyName)
    {
        if ($this->selectedRow !== null) {
            $this->resetSelectedRow();
        }

    }
    public function resetSelectedRow()
    {
        $this->selectedRow = null;
    }



    public function render()
    {
        $products = Product::paginate(10);

        return view('livewire.crud-table', [
            'data' => $products,
        ]);
    }
}
