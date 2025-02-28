<?php

use App\Http\Controllers\BarberController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

// Barber
Route::get('barbers', [BarberController::class, 'index']);
Route::get('barbers/{id}', [BarberController::class, 'show']);
Route::post('barbers', [BarberController::class, 'store']);
Route::put('barbers/{id}', [BarberController::class, 'update']);
Route::delete('barbers/{id}', [BarberController::class, 'destroy']);

// Appointment
Route::get('appointments', [AppointmentController::class, 'index']);
Route::get('appointments/{id}', [AppointmentController::class, 'show']);
Route::post('appointments', [AppointmentController::class, 'store']);
Route::put('appointments/{id}', [AppointmentController::class, 'update']);
Route::delete('appointments/{id}', [AppointmentController::class, 'destroy']);
