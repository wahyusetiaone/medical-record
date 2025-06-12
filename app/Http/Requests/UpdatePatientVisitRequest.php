<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientVisitRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'patient_id'        => 'sometimes|required|exists:patients,id',
            'insurance_type_id' => 'sometimes|nullable|exists:insurance_types,id',
            'visit_type_id'     => 'sometimes|nullable|exists:visit_types,id',
            'treatment_type_id' => 'sometimes|nullable|exists:treatment_types,id',
            'polyclinic_id'     => 'sometimes|nullable|exists:polyclinics,id',
            'doctor_id'         => 'sometimes|nullable|exists:doctors,id',
            'schedule'          => 'sometimes|nullable|date',
            'path_general_consent' => 'sometimes|nullable|string',
        ];
    }
}
