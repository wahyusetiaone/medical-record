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
            'insurance_type_id' => 'exists:insurance_types,id',
            'visit_type_id' => 'exists:visit_types,id',
            'treatment_type_id' => 'exists:treatment_types,id',
            'polyclinic_id' => 'exists:polyclinics,id',
            'doctor_id' => 'exists:doctors,id',
            'schedule' => 'date',
        ];
    }
}

