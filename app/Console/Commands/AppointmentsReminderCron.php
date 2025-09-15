<?php

namespace App\Console\Commands;

use App\Models\UserAppointment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AppointmentsReminderCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments_reminder:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $appointments = UserAppointment::notNotified()
            ->whereDate('time', Carbon::today())
            ->get();

        foreach ($appointments as $appointment) {
            // TODO:: notify by email

            # Notify the user
            info(sprintf('Appointment #%d: Email is sent to remind client %s', $appointment->id, $appointment->user->full_name));
            $appointment->update([
                'notified_at' => Carbon::now(),
            ]);
        }
    }
}
