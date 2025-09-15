<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\AppointmentController;

Route::resource('appointments', AppointmentController::class);
Route::get('/', [AppointmentController::class, 'index'])->name('appointments.index');
