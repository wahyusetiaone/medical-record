<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Http\Requests\StoreClinicRequest;
use App\Http\Requests\UpdateClinicRequest;
use App\Http\Requests\IndexClinicRequest;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller
{
    public function index(IndexClinicRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;

            $query = Clinic::query();
            $userClinicIds = Auth::user()->getClinicIds();
            if (!empty($userClinicIds)) {
                $query->whereIn('clinic_id', $userClinicIds);
            }

            if ($search) {
                $query->where('name', 'like', "%{$search}%");
            }

            $data = $query->paginate($size, ['*'], 'page', $page)->asCustomPaginate();

            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve clinics', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreClinicRequest $request)
    {
        try {
            $validated = $request->validated();

            $clinic = Clinic::create($validated);

            return GlobalResponse::success($clinic, 'Clinic berhasil dibuat');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to create clinic', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Clinic $clinic)
    {
        try {
            return GlobalResponse::success($clinic, 'Data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve clinic', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateClinicRequest $request, Clinic $clinic)
    {
        try {
            $validated = $request->validated();

            $clinic->update($validated);

            return GlobalResponse::success($clinic, 'Clinic berhasil diupdate');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update clinic', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Clinic $clinic)
    {
        try {
            $clinic->delete();

            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete clinic', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAllData(Request $request)
    {
        $searchQuery = $request->has('searchQuery') ? $request->input('searchQuery') : null;

        try {
            $query = Clinic::query();

            if ($searchQuery) {
                $query->where('name', 'like', "%{$searchQuery}%");
            }

            $data = $query->get();

            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve clinics', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
