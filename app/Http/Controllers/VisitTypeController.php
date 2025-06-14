<?php

namespace App\Http\Controllers;

use App\Models\VisitType;
use App\Http\Requests\StoreVisitTypeRequest;
use App\Http\Requests\UpdateVisitTypeRequest;
use App\Http\Requests\IndexVisitTypeRequest;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class VisitTypeController extends Controller
{
    public function index(IndexVisitTypeRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;

            $query = VisitType::query();
            $userClinicIds = Auth::user()->getClinicIds();
            if (!empty($userClinicIds)) {
                $query->whereIn('clinic_id', $userClinicIds);
            }
            if ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            }
            $data = $query->paginate($size, ['*'], 'page', $page)->asCustomPaginate();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve visit types', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
//        try {
//            $visitType = VisitType::create($request->validated());
//            return GlobalResponse::success($visitType, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
//        } catch (\Exception $e) {
//            return GlobalResponse::error('Failed to create visit type', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
//        }
        return GlobalResponse::success($request->all(), 'Logs', Response::HTTP_CREATED);
    }

    public function show(VisitType $visitType)
    {
        try {
            return GlobalResponse::success($visitType, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve visit type', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateVisitTypeRequest $request, VisitType $visitType)
    {
        try {
            $visitType->update($request->validated());
            return GlobalResponse::success($visitType, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update visit type', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(VisitType $visitType)
    {
        try {
            $visitType->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete visit type', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get all visit types as array, optionally filtered by name.
     *
     * @param string|null $searchQuery
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData(Request $request)
    {
        $clinic_id = $request->has('clinic_id') ? $request->input('clinic_id') : null;
        $searchQuery = $request->has('searchQuery') ? $request->input('searchQuery') : null;
        try {
            $query = VisitType::query();
            if (!empty($clinic_id)) {
                $query->where('clinic_id', $clinic_id);
            }
            if ($searchQuery) {
                $query->where('name', 'like', "%{$searchQuery}%");
            }
            $data = $query->get()->toArray();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve visit types', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
