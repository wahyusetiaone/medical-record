<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHealtyDataRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'is_pregnant_or_breastfeeding' => 'required|boolean',
            'smoker_status' => 'required|boolean',
            'main_complaint' => 'required|string|max:255',
            'anamnesis' => 'required|string|max:255',
            'disease_history' => 'required|string|max:255',
            'drug_allergy_history' => 'required|string|max:255',
            'other_allergy_history' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
        ];
    }
}

