<?php

namespace App\Http\Controllers;

use App\Models\InsuranceType;
use App\Http\Requests\StoreInsuranceTypeRequest;
use App\Http\Requests\UpdateInsuranceTypeRequest;
use App\Http\Requests\IndexInsuranceTypeRequest;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InsuranceTypeController extends Controller
{
    public function index(IndexInsuranceTypeRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;

            $query = InsuranceType::query();
            if ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            }
            $data = $query->paginate($size, ['*'], 'page', $page)->asCustomPaginate();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve insurance types', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreInsuranceTypeRequest $request)
    {
        try {
            $insuranceType = InsuranceType::create($request->validated());
            return GlobalResponse::success($insuranceType, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to create insurance type', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(InsuranceType $insuranceType)
    {
        try {
            return GlobalResponse::success($insuranceType, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve insurance type', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateInsuranceTypeRequest $request, InsuranceType $insuranceType)
    {
        try {
            $insuranceType->update($request->validated());
            return GlobalResponse::success($insuranceType, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update insurance type', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(InsuranceType $insuranceType)
    {
        try {
            $insuranceType->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete insurance type', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get all insurance types as array, optionally filtered by name.
     *
     * @param string|null $searchQuery
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData(Request $request)
    {
        $searchQuery = $request->has('searchQuery') ? $request->input('searchQuery') : null;
        try {
            $query = InsuranceType::query();
            if ($searchQuery) {
                $query->where('name', 'like', "%{$searchQuery}%");
            }
            $data = $query->get()->toArray();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve insurance types', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
