<?php

namespace App\Http\Controllers;

use App\Models\RequareAction;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\IndexRequareActionRequest;
use App\Http\Requests\StoreRequareActionRequest;
use App\Http\Requests\UpdateRequareActionRequest;

class RequareActionController extends Controller
{
    public function index(IndexRequareActionRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;
            $query = RequareAction::query();
            if ($search) {
                // Add search logic if needed
            }
            $data = $query->paginate($size, ['*'], 'page', $page)->asCustomPaginate();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve requare actions', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreRequareActionRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $patientId = $validated['initial_assessment_id'];
            $requareAction = RequareAction::create(collect($validated)->except('initial_assessment_id')->toArray());
            $assessment = \App\Models\InitialAssessment::findOrFail($patientId);
            $assessment->requare_action_id = $requareAction->id;
            $assessment->save();
            DB::commit();
            return GlobalResponse::success($requareAction, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return GlobalResponse::error('Failed to create requare action', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(RequareAction $requareAction)
    {
        try {
            return GlobalResponse::success($requareAction, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve requare action', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateRequareActionRequest $request, RequareAction $requareAction)
    {
        try {
            $requareAction->update($request->validated());
            return GlobalResponse::success($requareAction, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update requare action', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(RequareAction $requareAction)
    {
        try {
            $requareAction->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete requare action', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
