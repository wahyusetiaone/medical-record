<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFunctionalDataRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'assistive_device' => 'sometimes|required|boolean',
            'physical_disability' => 'sometimes|required|boolean',
            'daily_activity' => 'sometimes|required|string|max:255',
            'note' => 'sometimes|required|string|max:255',
            'patient_id' => 'sometimes|required|exists:patients,id',
        ];
    }
}

