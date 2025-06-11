<?php

namespace App\Http\Controllers;

use App\Models\FunctionalData;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\IndexFunctionalDataRequest;
use App\Http\Requests\StoreFunctionalDataRequest;
use App\Http\Requests\UpdateFunctionalDataRequest;

class FunctionalDataController extends Controller
{
    public function index(IndexFunctionalDataRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;
            $query = FunctionalData::query();
            if ($search) {
                // Add search logic if needed
            }
            $data = $query->paginate($size, ['*'], 'page', $page)->asCustomPaginate();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve functional data', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreFunctionalDataRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $patientId = $validated['patient_id'];
            $functionalData = FunctionalData::create(collect($validated)->except('patient_id')->toArray());
            $patient = \App\Models\Patient::findOrFail($patientId);
            $patient->functional_data_id = $functionalData->id;
            $patient->save();
            DB::commit();
            return GlobalResponse::success($functionalData, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return GlobalResponse::error('Failed to create functional data', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(FunctionalData $functionalData)
    {
        try {
            return GlobalResponse::success($functionalData, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve functional data', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateFunctionalDataRequest $request, FunctionalData $functionalData)
    {
        try {
            $functionalData->update($request->validated());
            return GlobalResponse::success($functionalData, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update functional data', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(FunctionalData $functionalData)
    {
        try {
            $functionalData->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete functional data', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
