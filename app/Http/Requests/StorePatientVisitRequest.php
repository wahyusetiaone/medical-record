<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientVisitRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'insurance_type_id' => 'exists:insurance_types,id|nullable',
            'visit_type_id' => 'exists:visit_types,id|nullable',
            'treatment_type_id' => 'exists:treatment_types,id|nullable',
            'polyclinic_id' => 'exists:polyclinics,id|nullable',
            'doctor_id' => 'exists:doctors,id|nullable',
            'schedule' => 'date|nullable',
            'path_general_consent' => 'string|nullable',
        ];
    }
}
