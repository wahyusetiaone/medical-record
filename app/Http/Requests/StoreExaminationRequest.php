<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExaminationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'consciousness' => 'required|string|max:255',
            'respiration' => 'required|string|max:255',
            'get_up_and_go_test' => 'required|string|max:255',
            'fall_risk' => 'required|string|max:255',
            'pain_scale' => 'required|string|max:255',
            'cough' => 'required|string|max:255',
            'initial_assessment_id' => 'required|exists:initial_assessments,id',
        ];
    }
}

