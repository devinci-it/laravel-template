<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchBar extends Component
{
    public $model;
    public $searchColumns;
    public $queryTerm;
    public $results; // Add this line

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($model, $searchColumns)
    {
        $this->model = $model;
        $this->searchColumns = $searchColumns;
    }

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        if (request()->has('query')) {
            $this->queryTerm = request('query');
            $this->results = $this->search();
        }
    }

    /**
     * Perform the search.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function search()
    {
        return $this->model::where(function($query) {
            foreach ($this->searchColumns as $column) {
                $query->orWhere($column, 'like', '%' . $this->queryTerm . '%');
            }
        })->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.search-bar', ['results' => $this->results]); // Modify this line
    }
}
