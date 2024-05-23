<?php

namespace App\Livewire;
use Livewire\Component;
use Illuminate\Support\Str;

class SearchComponent extends Component
{
    public $model;
    public $searchColumns = [];
    public $searchTerm = '';
    public $results = [];

    public function updatedSearchTerm()
    {
        $this->results = $this->model::where(function ($query) {
            foreach ($this->searchColumns as $column) {
                $query->orWhere($column, 'like', '%' . $this->searchTerm . '%');
            }
        })->get();
    }

    public function render()
    {
        return view('livewire.search-component');
    }
}
