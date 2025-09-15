<?php

namespace App\View\Components\Client;

use App\Http\Services\NotificationMethodService;
use Illuminate\View\Component;

class NotificationMethodsComponent extends Component
{
    /**
     * Value to be selected
     */
    public $value;

    /**
     * Active notification methods
     */
    public $notificationMethods;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value = null)
    {
        $this->value = $value;
        $notificationMethodService = new NotificationMethodService();
        $this->notificationMethods = $notificationMethodService->index();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notification-methods-component');
    }
}
