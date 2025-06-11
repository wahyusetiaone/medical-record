<?php

namespace App\Http\Controllers;

use App\Models\InitialAssessment;
use App\Http\Requests\IndexInitialAssessmentRequest;
use App\Http\Requests\StoreInitialAssessmentRequest;
use App\Http\Requests\UpdateInitialAssessmentRequest;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Response;

class InitialAssessmentController extends Controller
{
    public function index(IndexInitialAssessmentRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;
            $query = InitialAssessment::query();
            if ($search) {
                // Add search logic if needed
            }
            $data = $query->paginate($size, ['*'], 'page', $page)->asCustomPaginate();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve initial assessments', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreInitialAssessmentRequest $request)
    {
        try {
            $validated = $request->validated();
            $assessment = InitialAssessment::create($validated);
            return GlobalResponse::success($assessment, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to create initial assessment', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(InitialAssessment $initialAssessment)
    {
        try {
            return GlobalResponse::success($initialAssessment, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve initial assessment', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateInitialAssessmentRequest $request, InitialAssessment $initialAssessment)
    {
        try {
            $initialAssessment->update($request->validated());
            return GlobalResponse::success($initialAssessment, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update initial assessment', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(InitialAssessment $initialAssessment)
    {
        try {
            $initialAssessment->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete initial assessment', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

