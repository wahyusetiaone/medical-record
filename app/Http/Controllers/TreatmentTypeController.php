<?php

namespace App\Http\Controllers;

use App\Models\TreatmentType;
use App\Http\Requests\StoreTreatmentTypeRequest;
use App\Http\Requests\UpdateTreatmentTypeRequest;
use App\Http\Requests\IndexTreatmentTypeRequest;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
            $userClinicIds = Auth::user()->getClinicIds();
            if (!empty($userClinicIds)) {
                $query->whereIn('clinic_id', $userClinicIds);
            }
            if ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%");
            }
            $data = $query->paginate($size, ['*'], 'page', $page)->asCustomPaginate();
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

    /**
     * Get all treatment types as array, optionally filtered by name.
     *
     * @param string|null $searchQuery
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData(Request $request)
    {
        $clinic_id = $request->has('clinic_id') ? $request->input('clinic_id') : null;
        $searchQuery = $request->has('searchQuery') ? $request->input('searchQuery') : null;
        try {
            $query = TreatmentType::query();
            if (!empty($clinic_id)) {
                $query->where('clinic_id', $clinic_id);
            }
            if ($searchQuery) {
                $query->where('name', 'like', "%{$searchQuery}%");
            }
            $data = $query->get()->toArray();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve treatment types', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
