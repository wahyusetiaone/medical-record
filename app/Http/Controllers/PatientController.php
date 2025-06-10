<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\IndexPatientRequest;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Exception;

class PatientController extends Controller
{
    /**
     * Display a listing of the patients.
     *
     * @param  \App\Http\Requests\IndexPatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(IndexPatientRequest $request)
    {
        try {
            $validated = $request->validated();

            $page = $validated['page'] ?? 1;
            $size = $validated['size'] ?? 15;
            $search = $validated['search'] ?? null;

            $query = Patient::with(['identity', 'address', 'social']);

            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->whereHas('identity', function($q) use ($search) {
                        $q->where('full_name', 'like', "%{$search}%")
                          ->orWhere('phone_number', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%")
                          ->orWhere('identity_number', 'like', "%{$search}%");
                    })
                    ->orWhereHas('address', function($q) use ($search) {
                        $q->where('full_address', 'like', "%{$search}%")
                          ->orWhere('city', 'like', "%{$search}%")
                          ->orWhere('district', 'like', "%{$search}%");
                    })
                    ->orWhereHas('social', function($q) use ($search) {
                        $q->where('religion', 'like', "%{$search}%")
                          ->orWhere('work', 'like', "%{$search}%");
                    });
                });
            }

            $patients = $query->paginate($size, ['*'], 'page', $page);

            return GlobalResponse::success($patients, 'Patients retrieved successfully');
        } catch (Exception $e) {
            return GlobalResponse::error('Failed to retrieve patients', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified patient.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $patient = Patient::with(['identity', 'address', 'social'])->findOrFail($id);
            return GlobalResponse::success($patient, 'Patient retrieved successfully');
        } catch (Exception $e) {
            return GlobalResponse::error('Failed to retrieve patient', $e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Store a newly created patient in storage.
     *
     * @param  \App\Http\Requests\StorePatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePatientRequest $request)
    {
        $validated = $request->validated();
        try {
            $patient = DB::transaction(function () use ($validated) {
                $identityId = null;
                if (isset($validated['identity']) && is_array($validated['identity'])) {
                    $identity = \App\Models\Identity::create($validated['identity']);
                    $identityId = $identity->id;
                }
                $addressId = null;
                if (isset($validated['address']) && is_array($validated['address'])) {
                    $address = \App\Models\Address::create($validated['address']);
                    $addressId = $address->id;
                }
                $socialId = null;
                if (isset($validated['social']) && is_array($validated['social'])) {
                    $social = \App\Models\Social::create($validated['social']);
                    $socialId = $social->id;
                }
                $patient = Patient::create([
                    'identity_id' => $identityId,
                    'address_id' => $addressId,
                    'social_id' => $socialId,
                ]);
                $patient->load(['identity', 'address', 'social']);
                return $patient;
            });
            return GlobalResponse::success($patient, 'Patient created successfully', Response::HTTP_CREATED);
        } catch (Exception $e) {
            return GlobalResponse::error('Failed to create patient', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified patient in storage.
     *
     * @param  \App\Http\Requests\UpdatePatientRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePatientRequest $request, $id)
    {
        try {
            $patient = Patient::findOrFail($id);
            $validated = $request->validated();
            $patient = DB::transaction(function () use ($patient, $validated) {
                if (isset($validated['identity']) && is_array($validated['identity'])) {
                    $patient->identity->update($validated['identity']);
                }
                if (isset($validated['address']) && is_array($validated['address'])) {
                    $patient->address->update($validated['address']);
                }
                if (isset($validated['social']) && is_array($validated['social'])) {
                    $patient->social->update($validated['social']);
                }
                $patient->load(['identity', 'address', 'social']);
                return $patient;
            });
            return GlobalResponse::success($patient, 'Patient updated successfully');
        } catch (Exception $e) {
            return GlobalResponse::error('Failed to update patient', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified patient from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $patient = Patient::findOrFail($id);
            $patient->delete();
            return GlobalResponse::success(null, 'Patient deleted successfully');
        } catch (Exception $e) {
            return GlobalResponse::error('Failed to delete patient', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get all patients as array, optionally filtered by name (full_name).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData(Request $request)
    {
        $searchQuery = $request->has('searchQuery') ? $request->input('searchQuery') : null;
        try {
            $query = Patient::with(['identity', 'address', 'social']);
            if ($searchQuery) {
                $query->whereHas('identity', function($q) use ($searchQuery) {
                    $q->where('full_name', 'like', "%{$searchQuery}%");
                });
            }
            $data = $query->get()->toArray();
            return GlobalResponse::success($data, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error('Failed to retrieve patients', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
