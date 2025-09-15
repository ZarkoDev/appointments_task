<?php

namespace App\Events;

use App\Models\UserAppointment;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * @property $appointment;
 */
class AppointmentCreatedEvent
{
    use Dispatchable, SerializesModels;

    /**
     * The appointment
     *
     * @var UserAppointment
     */
    public $appointment;

    public function __construct(UserAppointment $appointment)
    {
        $this->appointment = $appointment;
    }
}
