<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVitalSignRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body_temperature' => 'sometimes|required|string|max:10',
            'pulse' => 'sometimes|required|string|max:10',
            'systolic' => 'sometimes|required|string|max:10',
            'diastolic' => 'sometimes|required|string|max:10',
            'respiratory_rate' => 'sometimes|required|string|max:10',
            'patient_id' => 'sometimes|required|exists:patients,id',
        ];
    }
}

