<?php

namespace App\Http\Controllers\Api;

use App\Events\AppointmentDeletedEvent;
use App\Http\Controllers\Requests\Client\Appointments\AppointmentIndexRequest;
use App\Http\Controllers\Requests\Client\Appointments\AppointmentStoreRequest;
use App\Http\Controllers\Requests\Client\Appointments\AppointmentUpdateRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Services\AppointmentService;
use App\Http\Services\UserService;
use App\Models\User;
use App\Models\UserAppointment;
use Illuminate\Support\Facades\DB;

class AppointmentController extends ApiController
{
    /**
     *  List all appointments
     *
     * @param AppointmentIndexRequest $request
     * @return mixed
     */
    public function index(AppointmentIndexRequest $request, AppointmentService $appointmentService)
    {
        $appointments = $appointmentService->index($request);

        return $this->sendResponse(AppointmentResource::collection($appointments)->response()->getData(true));
    }

    /**
     * Return the specific appointment details
     *
     * @param UserAppointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(UserAppointment $appointment)
    {
        return $this->sendResponse(new AppointmentResource($appointment));
    }

    /**
     * Store the appointment with his user
     *
     * @param AppointmentStoreRequest $request
     * @param UserService $userService
     * @param AppointmentService $appointmentService
     * @return \Illuminate\Http\Response
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
            $appointment = $appointmentService->store($request, $user);

            DB::commit();
        } catch (\Error $exception) {
            DB::rollBack();
            return $this->sendError('Неуспешно записване на час.');
        }

        return $this->sendResponse(new AppointmentResource($appointment), 'Успешно запазихте час! Клиентът ще бъде уведомен чрез [SMS/Email].');
    }

    /**
     * Update the appointment and his user
     *
     * @param AppointmentUpdateRequest $request
     * @param UserAppointment $appointment
     * @param UserService $userService
     * @param AppointmentService $appointmentService
     * @return \Illuminate\Http\Response
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
        } catch (\Error $exception) {
            DB::rollBack();
            return $this->sendError('Неуспешна промяна на час.');
        }

        return $this->sendResponse([], 'Успешна промяна на час!');
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

        return $this->sendResponse([], 'Успешно изтрит час!');
    }
}
