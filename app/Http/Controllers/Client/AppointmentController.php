<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\UserAppointment;
use Illuminate\Support\Facades\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = UserAppointment::query()
            ->with('user')
            ->latest()
            ->paginate();

        return view('client.appointments.index', compact('appointments'));
    }
}
