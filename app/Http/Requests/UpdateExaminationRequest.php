<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExaminationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'consciousness' => 'sometimes|required|string|max:255',
            'respiration' => 'sometimes|required|string|max:255',
            'get_up_and_go_test' => 'sometimes|required|string|max:255',
            'fall_risk' => 'sometimes|required|string|max:255',
            'pain_scale' => 'sometimes|required|string|max:255',
            'cough' => 'sometimes|required|string|max:255',
            'patient_id' => 'sometimes|required|exists:patients,id',
        ];
    }
}

