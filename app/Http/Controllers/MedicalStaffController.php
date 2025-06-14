<?php

namespace App\Http\Controllers;

use App\Models\MedicalStaff;
use App\Http\Requests\StoreMedicalStaffRequest;
use App\Http\Requests\UpdateMedicalStaffRequest;
use App\Http\Requests\IndexMedicalStaffRequest;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class MedicalStaffController extends Controller
{
    public function index(IndexMedicalStaffRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;

            $query = MedicalStaff::query();

            if ($search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('division', 'like', "%{$search}%");
            }

            $data = $query->paginate($size, ['*'], 'page', $page)->asCustomPaginate();

            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve medical staff', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreMedicalStaffRequest $request)
    {
        try {
            $validated = $request->validated();

            $medicalStaff = MedicalStaff::create($validated);

            return GlobalResponse::success($medicalStaff, 'Medical Staff berhasil dibuat');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to create medical staff', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(MedicalStaff $medicalStaff)
    {
        try {
            return GlobalResponse::success($medicalStaff, 'Data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve medical staff', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateMedicalStaffRequest $request, MedicalStaff $medicalStaff)
    {
        try {
            $validated = $request->validated();

            $medicalStaff->update($validated);

            return GlobalResponse::success($medicalStaff, 'Medical Staff berhasil diupdate');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update medical staff', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(MedicalStaff $medicalStaff)
    {
        try {
            $medicalStaff->delete();

            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete medical staff', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAllData(Request $request)
    {
        $clinic_id = $request->has('clinic_id') ? $request->input('clinic_id') : null;
        $searchQuery = $request->has('searchQuery') ? $request->input('searchQuery') : null;

        try {
            $query = MedicalStaff::query();
            if (!empty($clinic_id)) {
                $query->where('clinic_id', $clinic_id);
            }

            if ($searchQuery) {
                $query->where('nama', 'like', "%{$searchQuery}%")
                      ->orWhere('division', 'like', "%{$searchQuery}%");
            }

            $data = $query->get();

            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve medical staff', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
