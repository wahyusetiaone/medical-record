<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVitalSignRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body_temperature' => 'required|string|max:10',
            'pulse' => 'required|string|max:10',
            'systolic' => 'required|string|max:10',
            'diastolic' => 'required|string|max:10',
            'respiratory_rate' => 'required|string|max:10',
            'patient_id' => 'required|exists:patients,id',
        ];
    }
}

