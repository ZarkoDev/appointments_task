<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\AppointmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('users', [UserController::class, 'index'])->name('users.index');
