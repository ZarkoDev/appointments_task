<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppointmentController;

//Route::resource('appointments', AppointmentController::class);
Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::delete('appointments/{appointment}', [AppointmentController::class, 'delete'])->name('appointments.delete');
