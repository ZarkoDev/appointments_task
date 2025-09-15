<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\NotificationMethodController;

Route::resource('appointments', AppointmentController::class);
Route::get('notification-methods', [NotificationMethodController::class, 'index']);

