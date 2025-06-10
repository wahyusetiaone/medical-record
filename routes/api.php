<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\InsuranceTypeController;
use App\Http\Controllers\VisitTypeController;
use App\Http\Controllers\TreatmentTypeController;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PatientVisitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware([])->group(function () {
    // Patient API Routes
    Route::apiResource('patients', PatientController::class)->except(['create', 'edit']);

    // Insurance Type API Routes
    Route::apiResource('insurance-types', InsuranceTypeController::class)->except(['create', 'edit']);

    // Visit Type API Routes
    Route::apiResource('visit-types', VisitTypeController::class)->except(['create', 'edit']);

    // Treatment Type API Routes
    Route::apiResource('treatment-types', TreatmentTypeController::class)->except(['create', 'edit']);

    // Polyclinic API Routes
    Route::apiResource('polyclinics', PolyclinicController::class)->except(['create', 'edit']);

    // Doctor API Routes
    Route::apiResource('doctors', DoctorController::class)->except(['create', 'edit']);

    // Schedule API Routes
    Route::apiResource('schedules', ScheduleController::class)->except(['create', 'edit']);

    // Patient Visit API Routes
    Route::apiResource('patient-visits', PatientVisitController::class)->except(['create', 'edit']);

    // Custom getAllData endpoints
    Route::get('doctors-all', [DoctorController::class, 'getAllData']);
    Route::get('insurance-types-all', [InsuranceTypeController::class, 'getAllData']);
    Route::get('patients-all', [PatientController::class, 'getAllData']);
    Route::get('patient-visits-all', [PatientVisitController::class, 'getAllData']);
    Route::get('polyclinics-all', [PolyclinicController::class, 'getAllData']);
    Route::get('schedules-all', [ScheduleController::class, 'getAllData']);
    Route::get('treatment-types-all', [TreatmentTypeController::class, 'getAllData']);
    Route::get('visit-types-all', [VisitTypeController::class, 'getAllData']);
});
