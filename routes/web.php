<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ReviewController;

// ── Public ─────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// ── Patient Auth ────────────────────────────────────────────────────────────
Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/appointments/{appointment}/review', [ReviewController::class, 'store'])->name('review.store');

Route::get('/login',   [AuthController::class, 'showPatientLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'patientLogin'])->name('patient.login.post');
Route::post('/logout', [AuthController::class, 'patientLogout'])->name('patient.logout');

// ── Doctor Auth ─────────────────────────────────────────────────────────────
Route::get('/doctor/login',   [AuthController::class, 'showDoctorLogin'])->name('doctor.login');
Route::post('/doctor/login',  [AuthController::class, 'doctorLogin'])->name('doctor.login.post');
Route::post('/doctor/logout', [AuthController::class, 'doctorLogout'])->name('doctor.logout');

// ── Patient Area (authenticated) ─────────────────────────────────────────────
Route::middleware('auth:patient')->group(function () {
    Route::get('/dashboard',                           [PatientController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('/departments',                         [PatientController::class, 'departments'])->name('patient.departments');
    Route::get('/departments/{department}/doctors',    [PatientController::class, 'doctors'])->name('patient.doctors');
    Route::get('/doctors/{doctor}/book',               [PatientController::class, 'bookForm'])->name('patient.book.form');
    Route::post('/doctors/{doctor}/book',              [PatientController::class, 'book'])->name('patient.book');
    Route::get('/appointments/{appointment}',          [PatientController::class, 'appointment'])->name('patient.appointment');
});

// ── Doctor Area (authenticated) ───────────────────────────────────────────────
Route::middleware('auth:doctor')->group(function () {
    Route::get('/doctor/dashboard',                              [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
    Route::patch('/doctor/appointments/{appointment}/status',   [DoctorController::class, 'updateStatus'])->name('doctor.appointment.status');
});