<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\InsuranceTypeController;
use App\Http\Controllers\VisitTypeController;
use App\Http\Controllers\TreatmentTypeController;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PatientVisitController;
use App\Http\Controllers\ResponsiblePersonController;
use App\Http\Controllers\InitialAssessmentController;
use App\Http\Controllers\VitalSignController;
use App\Http\Controllers\HealtyDataController;
use App\Http\Controllers\PhysicalMeasurementController;
use App\Http\Controllers\FunctionalDataController;
use App\Http\Controllers\PsikoSosBudController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\RequareActionController;
use App\Http\Controllers\ChiefComplaintController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\MedicalStaffController;
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

Route::middleware(['api'])->group(function () {
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

    // Responsible Person API Routes
    Route::apiResource('responsible-people', ResponsiblePersonController::class)->except(['create', 'edit']);
// Clinic API Routes
    Route::apiResource('clinics', ClinicController::class)->except(['create', 'edit']);

// Medical Staff API Routes
    Route::apiResource('medical-staff', MedicalStaffController::class)->except(['create', 'edit']);

    // Initial Assessment API Routes
    Route::apiResource('initial-assessments', InitialAssessmentController::class)->except(['create', 'edit']);
    Route::apiResource('vital-signs', VitalSignController::class)->except(['create', 'edit']);
    Route::apiResource('healty-data', HealtyDataController::class)->except(['create', 'edit']);
    Route::apiResource('physical-measurements', PhysicalMeasurementController::class)->except(['create', 'edit']);
    Route::apiResource('functional-data', FunctionalDataController::class)->except(['create', 'edit']);
    Route::apiResource('psiko-sos-bud', PsikoSosBudController::class)->except(['create', 'edit']);
    Route::apiResource('examinations', ExaminationController::class)->except(['create', 'edit']);
    Route::apiResource('requare-actions', RequareActionController::class)->except(['create', 'edit']);

    // Custom getAllData endpoints
    Route::get('doctors-all', [DoctorController::class, 'getAllData']);
    Route::get('insurance-types-all', [InsuranceTypeController::class, 'getAllData']);
    Route::get('patients-all', [PatientController::class, 'getAllData']);
    Route::get('patient-visits-all', [PatientVisitController::class, 'getAllData']);
    Route::get('polyclinics-all', [PolyclinicController::class, 'getAllData']);
    Route::get('schedules-all', [ScheduleController::class, 'getAllData']);
    Route::get('treatment-types-all', [TreatmentTypeController::class, 'getAllData']);
    Route::get('visit-types-all', [VisitTypeController::class, 'getAllData']);
    Route::get('responsible-people-all', [ResponsiblePersonController::class, 'getAllData']);
    Route::get('chief-complaints', ChiefComplaintController::class);
    Route::get('clinics-all', [ClinicController::class, 'getAllData']);
    Route::get('medical-staff-all', [MedicalStaffController::class, 'getAllData']);
});

