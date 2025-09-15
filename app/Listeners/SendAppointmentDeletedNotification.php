<?php

namespace App\Listeners;

use App\Events\AppointmentDeletedEvent;

class SendAppointmentDeletedNotification
{
    /**
     * Handle the event.
     */
    public function handle(AppointmentDeletedEvent $event): void
    {
        // TODO:: Send real emails
        info(sprintf('Appointment deleted: #%s', $event->appointment->id));
    }
}
