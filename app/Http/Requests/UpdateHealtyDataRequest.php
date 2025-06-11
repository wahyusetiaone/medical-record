<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHealtyDataRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'is_pregnant_or_breastfeeding' => 'sometimes|required|boolean',
            'smoker_status' => 'sometimes|required|boolean',
            'main_complaint' => 'sometimes|required|string|max:255',
            'anamnesis' => 'sometimes|required|string|max:255',
            'disease_history' => 'sometimes|required|string|max:255',
            'drug_allergy_history' => 'sometimes|required|string|max:255',
            'other_allergy_history' => 'sometimes|required|string|max:255',
            'patient_id' => 'sometimes|required|exists:patients,id',
        ];
    }
}

