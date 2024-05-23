<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchBar extends Component
{
    public $model;
    public $searchColumns;
    public $queryTerm;
    public $results=null;

    public function mount($model, $searchColumns)
    {
        $this->model = $model;
        $this->searchColumns = $searchColumns;
    }

    public function updatedQueryTerm()
    {
        $this->results = $this->search();
    }

    protected function search()
    {
        $query=$this->queryTerm;
        $results = $this->model::where(function($query) {
            foreach ($this->searchColumns as $column) {
                $query->orWhere($column, 'like', '%' . $this->queryTerm . '%');
            }
        })->get();

        return $this->paginate($results);
    }

    protected function paginate($items, $perPage = 10)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $paginatedItems = new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page
        );

        return $paginatedItems;
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}
