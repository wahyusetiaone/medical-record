<?php

namespace App\Http\Controllers;

use App\Models\PatientVisit;
use App\Http\Requests\StorePatientVisitRequest;
use App\Http\Requests\UpdatePatientVisitRequest;
use App\Http\Requests\IndexPatientVisitRequest;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Response;

class PatientVisitController extends Controller
{
    public function index(IndexPatientVisitRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;

            $query = PatientVisit::with(['patient.identity','patient.address','patient.social', 'insuranceType', 'visitType', 'treatmentType', 'polyclinic', 'doctor']);
            if ($search) {
                $query->whereHas('patient', function($q) use ($search) {
                    $q->whereHas('identity', function($q) use ($search) {
                        $q->where('full_name', 'like', "%{$search}%");
                    });
                });
            }
            $visits = $query->paginate($size, ['*'], 'page', $page);
            return GlobalResponse::success($visits, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve patient visits', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StorePatientVisitRequest $request)
    {
        try {
            $visit = PatientVisit::create($request->validated());
            $visit->load(['patient.identity','patient.address','patient.social', 'insuranceType', 'visitType', 'treatmentType', 'polyclinic', 'doctor']);
            return GlobalResponse::success($visit, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to create patient visit', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(PatientVisit $patientVisit)
    {
        try {
            $patientVisit->load(['patient.identity','patient.address','patient.social', 'insuranceType', 'visitType', 'treatmentType', 'polyclinic', 'doctor']);
            return GlobalResponse::success($patientVisit, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve patient visit', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdatePatientVisitRequest $request, PatientVisit $patientVisit)
    {
        try {
            $patientVisit->update($request->validated());
            $patientVisit->load(['patient.identity','patient.address','patient.social', 'insuranceType', 'visitType', 'treatmentType', 'polyclinic', 'doctor']);
            return GlobalResponse::success($patientVisit, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update patient visit', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(PatientVisit $patientVisit)
    {
        try {
            $patientVisit->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete patient visit', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
