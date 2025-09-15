<?php

namespace App\Http\Services;

use App\Events\AppointmentCreatedEvent;
use App\Models\NotificationMethod;
use App\Models\User;
use App\Models\UserAppointment;

class AppointmentService
{

    /**
     * Return filtered appointments
     *
     * @param $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function index($request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $egn = $request->input('egn');
        $userId = $request->input('user_id');

        $appointments = UserAppointment::query()
            ->with('user', 'notification_method')
            ->when($from, function ($query) use ($from) {
                return $query->whereDate('time', '>=', $from);
            })
            ->when($to, function ($query) use ($to) {
                return $query->whereDate('time', '<=', $to);
            })
            ->when($egn, function ($query) use ($egn) {
                return $query->whereHas('user', function ($query) use ($egn) {
                    return $query->where('egn', $egn);
                });
            })
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->latest()
            ->paginate();

        return $appointments;
    }

    /**
     * Store the appointment
     *
     * @param $request
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store($request, User $user)
    {
        $notificationMethod = NotificationMethod::bySlug($request->input('notification_method'))->firstOrFail();
        $appointment = $user->appointments()->create([
            'time' => $request->input('time'),
            'notification_method_id' => $notificationMethod->id,
            'description' => $request->input('description'),
        ]);
        AppointmentCreatedEvent::dispatch($appointment);

        return $appointment;
    }

    /**
     * Update the appointment
     *
     * @param $request
     * @param $appointment
     * @return void
     */
    public function update($request, $appointment)
    {
        $notificationMethod = NotificationMethod::bySlug($request->input('notification_method'))->firstOrFail();
        $appointment->update([
            'time' => $request->input('time'),
            'notification_method_id' => $notificationMethod->id,
            'description' => $request->input('description'),
        ]);
    }
}
