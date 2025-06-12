<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\IndexExaminationRequest;
use App\Http\Requests\StoreExaminationRequest;
use App\Http\Requests\UpdateExaminationRequest;

class ExaminationController extends Controller
{
    public function index(IndexExaminationRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;
            $query = Examination::query();
            if ($search) {
                // Add search logic if needed
            }
            $data = $query->paginate($size, ['*'], 'page', $page)->asCustomPaginate();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve examinations', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreExaminationRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $patientId = $validated['initial_assessment_id'];
            $examination = Examination::create(collect($validated)->except('initial_assessment_id')->toArray());
            $assessment = \App\Models\InitialAssessment::findOrFail($patientId);
            $assessment->examination_id = $examination->id;
            $assessment->save();
            DB::commit();
            return GlobalResponse::success($examination, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return GlobalResponse::error('Failed to create examination', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Examination $examination)
    {
        try {
            return GlobalResponse::success($examination, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve examination', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateExaminationRequest $request, Examination $examination)
    {
        try {
            $examination->update($request->validated());
            return GlobalResponse::success($examination, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update examination', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Examination $examination)
    {
        try {
            $examination->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete examination', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
