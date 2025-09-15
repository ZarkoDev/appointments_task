<?php

namespace App\View\Components\Client;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class AppointmentsTableComponent extends Component
{
    /**
     * Appointments to be listed
     */
    public LengthAwarePaginator $appointments;

    /**
     * Should we show pagination
     */
    public bool $pagination;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(LengthAwarePaginator $appointments, bool $pagination = false)
    {
        $this->appointments = $appointments;
        $this->pagination = $pagination;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.appointments-table-component');
    }
}
