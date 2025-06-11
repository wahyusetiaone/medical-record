<?php

namespace App\Http\Controllers;

use App\Models\PsikoSosBud;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\IndexPsikoSosBudRequest;
use App\Http\Requests\StorePsikoSosBudRequest;
use App\Http\Requests\UpdatePsikoSosBudRequest;

class PsikoSosBudController extends Controller
{
    public function index(IndexPsikoSosBudRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;
            $query = PsikoSosBud::query();
            if ($search) {
                // Add search logic if needed
            }
            $data = $query->paginate($size, ['*'], 'page', $page)->asCustomPaginate();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve psiko sos bud', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StorePsikoSosBudRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $patientId = $validated['patient_id'];
            $psikoSosBud = PsikoSosBud::create(collect($validated)->except('patient_id')->toArray());
            $patient = \App\Models\Patient::findOrFail($patientId);
            $patient->psiko_sos_bud_id = $psikoSosBud->id;
            $patient->save();
            DB::commit();
            return GlobalResponse::success($psikoSosBud, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return GlobalResponse::error('Failed to create psiko sos bud', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(PsikoSosBud $psikoSosBud)
    {
        try {
            return GlobalResponse::success($psikoSosBud, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve psiko sos bud', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdatePsikoSosBudRequest $request, PsikoSosBud $psikoSosBud)
    {
        try {
            $psikoSosBud->update($request->validated());
            return GlobalResponse::success($psikoSosBud, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update psiko sos bud', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(PsikoSosBud $psikoSosBud)
    {
        try {
            $psikoSosBud->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete psiko sos bud', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
