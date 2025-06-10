<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Http\Requests\IndexScheduleRequest;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ScheduleController extends Controller
{
    public function index(IndexScheduleRequest $request)
    {
        try {
            $validated = $request->validated();
            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;

            $query = Schedule::with(['doctor', 'polyclinic']);
            if ($search) {
                $query->whereHas('doctor', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            }
            $data = $query->paginate($size, ['*'], 'page', $page);
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve schedules', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreScheduleRequest $request)
    {
        try {
            $schedule = Schedule::create($request->validated());
            return GlobalResponse::success($schedule, 'Data berhasil ditambahkan', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to create schedule', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Schedule $schedule)
    {
        try {
            $schedule->load(['doctor', 'polyclinic']);
            return GlobalResponse::success($schedule, 'Detail data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve schedule', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        try {
            $schedule->update($request->validated());
            $schedule->load(['doctor', 'polyclinic']);
            return GlobalResponse::success($schedule, 'Data berhasil diubah');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to update schedule', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Schedule $schedule)
    {
        try {
            $schedule->delete();
            return GlobalResponse::success(null, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to delete schedule', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get all schedules as array, optionally filtered by doctor name.
     *
     * @param string|null $searchQuery
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData(Request $request)
    {
        $searchQuery = $request->has('searchQuery') ? $request->input('searchQuery') : null;
        try {
            $query = Schedule::with(['doctor', 'polyclinic']);
            if ($searchQuery) {
                $query->whereHas('doctor', function($q) use ($searchQuery) {
                    $q->where('name', 'like', "%{$searchQuery}%");
                });
            }
            $data = $query->get()->toArray();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve schedules', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
