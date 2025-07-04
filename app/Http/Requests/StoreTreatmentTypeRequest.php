<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreatmentTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'clinic_id' => 'required|exists:clinics,id',
            'name' => 'required|string|max:255',
            'category' => 'required|in:inpatient,outpatient,emergency',
            'is_active' => 'boolean',
        ];
    }
}

