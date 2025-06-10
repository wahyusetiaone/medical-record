<?php

namespace App\Http\Controllers;

use App\Models\VisitType;
use App\Http\Requests\StoreVisitTypeRequest;
use App\Http\Requests\UpdateVisitTypeRequest;
use App\Http\Requests\IndexVisitTypeRequest;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
            if ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            }
            $data = $query->paginate($size, ['*'], 'page', $page);
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve visit types', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreVisitTypeRequest $request)
    {
        try {
            $visitType = VisitType::create($request->validated());
            return GlobalResponse::success($visitType, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to create visit type', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
        $searchQuery = $request->has('searchQuery') ? $request->input('searchQuery') : null;
        try {
            $query = VisitType::query();
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
