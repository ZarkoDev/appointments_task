<?php

namespace App\Listeners;

use App\Events\AppointmentCreatedEvent;

class SendAppointmentCrеatedNotification
{
    /**
     * Handle the event.
     */
    public function handle(AppointmentCreatedEvent $event): void
    {
        // TODO:: Send real emails
        info(sprintf('Appointment Created: #%s', $event->appointment->id));
    }
}
