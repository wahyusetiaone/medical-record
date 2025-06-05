<?php

namespace App\Http\Controllers;

use App\Models\TreatmentType;
use App\Http\Requests\StoreTreatmentTypeRequest;
use App\Http\Requests\UpdateTreatmentTypeRequest;
use App\Http\Requests\IndexTreatmentTypeRequest;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TreatmentTypeController extends Controller
{
    public function index(IndexTreatmentTypeRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;

            $query = TreatmentType::query();
            if ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%");
            }
            $data = $query->paginate($size, ['*'], 'page', $page);
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve treatment types', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreTreatmentTypeRequest $request)
    {
        try {
            $treatmentType = TreatmentType::create($request->validated());
            return GlobalResponse::success($treatmentType, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to create treatment type', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(TreatmentType $treatmentType)
    {
        try {
            return GlobalResponse::success($treatmentType, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve treatment type', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateTreatmentTypeRequest $request, TreatmentType $treatmentType)
    {
        try {
            $treatmentType->update($request->validated());
            return GlobalResponse::success($treatmentType, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update treatment type', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(TreatmentType $treatmentType)
    {
        try {
            $treatmentType->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete treatment type', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
