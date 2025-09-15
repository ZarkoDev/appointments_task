<?php

namespace App\View\Components\Client;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class PaginationComponent extends Component
{
    /**
     * Resources to be paginated
     */
    public LengthAwarePaginator $resources;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(LengthAwarePaginator $resources)
    {
        $this->resources = $resources;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pagination-component');
    }
}
