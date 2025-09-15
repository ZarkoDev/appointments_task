<?php

namespace App\Http\Controllers\Client;

use App\Events\AppointmentDeletedEvent;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Requests\Client\Appointments\AppointmentIndexRequest;
use App\Http\Controllers\Requests\Client\Appointments\AppointmentStoreRequest;
use App\Http\Controllers\Requests\Client\Appointments\AppointmentUpdateRequest;
use App\Http\Services\AppointmentService;
use App\Http\Services\UserService;
use App\Models\NotificationMethod;
use App\Models\User;
use App\Models\UserAppointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class AppointmentController extends Controller
{
    /**
     * List all appointments
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(AppointmentIndexRequest $request, AppointmentService $appointmentService)
    {
        $appointments = $appointmentService->index($request);

        return view('client.appointments.index', compact('appointments'));
    }

    /**
     * Show create view of the appointment
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $paymentMethods = NotificationMethod::onlyActive()->get();

        return view('client.appointments.create', compact('paymentMethods'));
    }

    /**
     * Store the appointment with his user
     *
     * @param AppointmentStoreRequest $request
     * @param UserService $userService
     * @param AppointmentService $appointmentService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(
        AppointmentStoreRequest $request,
        UserService $userService,
        AppointmentService  $appointmentService)
    {
        try {
            DB::beginTransaction();

            /*
             * It's possible with updateOrCreate by EGN but then we will have an issue.
             * - If we create an appointment with email and after that create another one with phone
             * then we will set the email as NULL and we won't be able to notify him
             */
            $user = User::byEGN($request->input('egn'))->first();

            if (! $user) {
                $user = new User([
                    'egn' => $request->input('egn'),
                ]);
            }

            $userService->update($request, $user);
            $appointmentService->store($request, $user);

            DB::commit();
        } catch (\Exception $exception) {
            session()->flash('error', 'Неуспешно записване на час.');
            DB::rollBack();
            return redirect()->back();
        }

        session()->flash('success', 'Успешно запазихте час! Клиентът ще бъде уведомен чрез [SMS/Email].');
        return redirect()->route('appointments.index');
    }

    /**
     * Show edit view of the appointment
     * Show latest appointments also
     *
     * @param UserAppointment $appointment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(UserAppointment $appointment) {
        $paymentMethods = NotificationMethod::onlyActive()->get();
        $appointments = $appointment->user->appointments()
            ->with('user', 'notification_method')
            ->where('id', '!=', $appointment->id)
            ->latest()
            ->limit(10)
            ->get();

        return view('client.appointments.edit', compact(
            'appointment',
            'appointments',
            'paymentMethods'
        ));
    }

    /**
     * Update the appointment and his user
     *
     * @param AppointmentUpdateRequest $request
     * @param UserAppointment $appointment
     * @param UserService $userService
     * @param AppointmentService $appointmentService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(
        AppointmentUpdateRequest $request,
        UserAppointment $appointment,
        UserService $userService,
        AppointmentService  $appointmentService)
    {
        try {
            DB::beginTransaction();

            $userService->update($request, $appointment->user);
            $appointmentService->update($request, $appointment);

            DB::commit();
        } catch (\Exception $exception) {
            session()->flash('error', 'Неуспешна промяна на час.');
            DB::rollBack();
            return redirect()->back();
        }

        session()->flash('success', 'Успешна промяна на час!');
        return redirect()->route('appointments.index');
    }

    /**
     * Delete the appointment
     *
     * @param UserAppointment $appointment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(UserAppointment $appointment)
    {
        $appointment->delete();
        AppointmentDeletedEvent::dispatch($appointment);
        session()->flash('success', 'Успешно изтрит час!');

        return redirect()->route('appointments.index');
    }
}
