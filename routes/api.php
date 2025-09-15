<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\NotificationMethodController;

Route::resource('appointments', AppointmentController::class);
Route::delete('appointments/{appointment}', [AppointmentController::class, 'delete'])->name('appointments.delete');

Route::get('notification-methods', [NotificationMethodController::class, 'index'])->name('notification-methods.index');

