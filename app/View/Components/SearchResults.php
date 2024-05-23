<?php
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchResults extends Component
{
    public $results;
    public $searchTerm;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(LengthAwarePaginator $results, $searchTerm)
    {
        $this->results = $results;
        $this->searchTerm = $searchTerm;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.search-results');
    }
}
