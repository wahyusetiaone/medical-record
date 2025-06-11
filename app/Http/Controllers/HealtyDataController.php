<?php

namespace App\Http\Controllers;

use App\Models\HealtyData;
use App\Http\Responses\GlobalResponse;
use App\Http\Requests\IndexHealtyDataRequest;
use App\Http\Requests\StoreHealtyDataRequest;
use App\Http\Requests\UpdateHealtyDataRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class HealtyDataController extends Controller
{
    public function index(IndexHealtyDataRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;
            $query = HealtyData::query();
            if ($search) {
                // Add search logic if needed
            }
            $data = $query->paginate($size, ['*'], 'page', $page)->asCustomPaginate();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve healty data', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreHealtyDataRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $patientId = $validated['patient_id'];
            $healtyData = HealtyData::create(collect($validated)->except('patient_id')->toArray());
            $patient = \App\Models\Patient::findOrFail($patientId);
            $patient->healty_data_id = $healtyData->id;
            $patient->save();
            DB::commit();
            return GlobalResponse::success($healtyData, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return GlobalResponse::error('Failed to create healty data', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(HealtyData $healtyData)
    {
        try {
            return GlobalResponse::success($healtyData, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve healty data', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateHealtyDataRequest $request, HealtyData $healtyData)
    {
        try {
            $healtyData->update($request->validated());
            return GlobalResponse::success($healtyData, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update healty data', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(HealtyData $healtyData)
    {
        try {
            $healtyData->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete healty data', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
