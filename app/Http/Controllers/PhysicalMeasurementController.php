<?php

namespace App\Http\Controllers;

use App\Models\PhysicalMeasurement;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\IndexPhysicalMeasurementRequest;
use App\Http\Requests\StorePhysicalMeasurementRequest;
use App\Http\Requests\UpdatePhysicalMeasurementRequest;

class PhysicalMeasurementController extends Controller
{
    public function index(IndexPhysicalMeasurementRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;
            $query = PhysicalMeasurement::query();
            if ($search) {
                // Add search logic if needed
            }
            $data = $query->paginate($size, ['*'], 'page', $page)->asCustomPaginate();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve physical measurements', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StorePhysicalMeasurementRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $patientId = $validated['patient_id'];
            $physicalMeasurement = PhysicalMeasurement::create(collect($validated)->except('patient_id')->toArray());
            $patient = \App\Models\Patient::findOrFail($patientId);
            $patient->physical_measurement_id = $physicalMeasurement->id;
            $patient->save();
            DB::commit();
            return GlobalResponse::success($physicalMeasurement, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return GlobalResponse::error('Failed to create physical measurement', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(PhysicalMeasurement $physicalMeasurement)
    {
        try {
            return GlobalResponse::success($physicalMeasurement, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve physical measurement', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdatePhysicalMeasurementRequest $request, PhysicalMeasurement $physicalMeasurement)
    {
        try {
            $physicalMeasurement->update($request->validated());
            return GlobalResponse::success($physicalMeasurement, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update physical measurement', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(PhysicalMeasurement $physicalMeasurement)
    {
        try {
            $physicalMeasurement->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete physical measurement', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
