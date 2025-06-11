<?php

namespace App\Http\Controllers;

use App\Models\VitalSign;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\IndexVitalSignRequest;
use App\Http\Requests\StoreVitalSignRequest;
use App\Http\Requests\UpdateVitalSignRequest;

class VitalSignController extends Controller
{
    public function index(IndexVitalSignRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $data = VitalSign::paginate($size, ['*'], 'page', $page)->asCustomPaginate();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve vital signs', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreVitalSignRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $patientId = $validated['patient_id'];
            $vitalSign = VitalSign::create(collect($validated)->except('patient_id')->toArray());
            $patient = \App\Models\Patient::findOrFail($patientId);
            $patient->vital_sign_id = $vitalSign->id;
            $patient->save();
            DB::commit();
            return GlobalResponse::success($vitalSign, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return GlobalResponse::error('Failed to create vital sign', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(VitalSign $vitalSign)
    {
        try {
            return GlobalResponse::success($vitalSign, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve vital sign', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateVitalSignRequest $request, VitalSign $vitalSign)
    {
        try {
            $vitalSign->update($request->validated());
            return GlobalResponse::success($vitalSign, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update vital sign', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(VitalSign $vitalSign)
    {
        try {
            $vitalSign->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete vital sign', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
