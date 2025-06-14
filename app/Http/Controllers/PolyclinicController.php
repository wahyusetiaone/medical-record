<?php

namespace App\Http\Controllers;

use App\Models\Polyclinic;
use App\Http\Requests\StorePolyclinicRequest;
use App\Http\Requests\UpdatePolyclinicRequest;
use App\Http\Requests\IndexPolyclinicRequest;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PolyclinicController extends Controller
{
    public function index(IndexPolyclinicRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;

            $query = Polyclinic::query();
            $userClinicIds = Auth::user()->getClinicIds();
            if (!empty($userClinicIds)) {
                $query->whereIn('clinic_id', $userClinicIds);
            }
            if ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('room_number', 'like', "%{$search}%");
            }
            $data = $query->paginate($size, ['*'], 'page', $page)->asCustomPaginate();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve polyclinics', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StorePolyclinicRequest $request)
    {
        try {
            $polyclinic = Polyclinic::create($request->validated());
            return GlobalResponse::success($polyclinic, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to create polyclinic', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Polyclinic $polyclinic)
    {
        try {
            return GlobalResponse::success($polyclinic, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve polyclinic', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdatePolyclinicRequest $request, Polyclinic $polyclinic)
    {
        try {
            $polyclinic->update($request->validated());
            return GlobalResponse::success($polyclinic, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update polyclinic', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Polyclinic $polyclinic)
    {
        try {
            $polyclinic->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete polyclinic', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get all polyclinics as array, optionally filtered by name.
     *
     * @param string|null $searchQuery
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData(Request $request)
    {
        $clinic_id = $request->has('clinic_id') ? $request->input('clinic_id') : null;
        $searchQuery = $request->has('searchQuery') ? $request->input('searchQuery') : null;
        try {
            $query = Polyclinic::query();
            if (!empty($clinic_id)) {
                $query->where('clinic_id', $clinic_id);
            }
            if ($searchQuery) {
                $query->where('name', 'like', "%{$searchQuery}%");
            }
            $data = $query->get()->toArray();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve polyclinics', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
