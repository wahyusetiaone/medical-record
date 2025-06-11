<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhysicalMeasurementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'height_cm' => 'sometimes|required|string|max:10',
            'weight_kg' => 'sometimes|required|string|max:10',
            'bmi' => 'sometimes|required|string|max:10',
            'patient_id' => 'sometimes|required|exists:patients,id',
        ];
    }
}

