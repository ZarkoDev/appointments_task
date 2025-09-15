<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\AppointmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('appointments', AppointmentController::class);
Route::get('/', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('appointments/{appointment}', [AppointmentController::class, 'delete'])->name('appointments.delete');
