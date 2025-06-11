<?php

namespace App\Http\Controllers;

use App\Models\ResponsiblePerson;
use App\Http\Requests\StoreResponsiblePersonRequest;
use App\Http\Requests\UpdateResponsiblePersonRequest;
use App\Http\Requests\IndexResponsiblePersonRequest;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ResponsiblePersonController extends Controller
{
    public function index(IndexResponsiblePersonRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;

            $query = ResponsiblePerson::query();
            if ($search) {
                $query->where('full_name', 'like', "%{$search}%")
                      ->orWhere('national_id_number', 'like', "%{$search}%")
                      ->orWhere('phone_number', 'like', "%{$search}%");
            }
            $data = $query->paginate($size, ['*'], 'page', $page)->asCustomPaginate();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve responsible persons', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreResponsiblePersonRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $patientId = $request->input('patient_id');
            if (!$patientId) {
                return GlobalResponse::error('patient_id is required', null, Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $responsiblePerson = ResponsiblePerson::create(collect($validated)->except('patient_id')->toArray());
            $patient = \App\Models\Patient::findOrFail($patientId);
            $patient->responsible_person_id = $responsiblePerson->id;
            $patient->save();
            DB::commit();
            return GlobalResponse::success($responsiblePerson, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return GlobalResponse::error('Failed to create responsible person', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(ResponsiblePerson $responsiblePerson)
    {
        try {
            return GlobalResponse::success($responsiblePerson, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve responsible person', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateResponsiblePersonRequest $request, ResponsiblePerson $responsiblePerson)
    {
        try {
            $responsiblePerson->update($request->validated());
            return GlobalResponse::success($responsiblePerson, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update responsible person', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(ResponsiblePerson $responsiblePerson)
    {
        try {
            $responsiblePerson->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete responsible person', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get all responsible persons as array, optionally filtered by name.
     *
     * @param string|null $searchQuery
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData(Request $request)
    {
        $searchQuery = $request->has('searchQuery') ? $request->input('searchQuery') : null;
        try {
            $query = ResponsiblePerson::query();
            if ($searchQuery) {
                $query->where('full_name', 'like', "%{$searchQuery}%");
            }
            $data = $query->get()->toArray();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve responsible persons', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
