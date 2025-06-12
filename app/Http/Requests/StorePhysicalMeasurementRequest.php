<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhysicalMeasurementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'height_cm' => 'required|string|max:10',
            'weight_kg' => 'required|string|max:10',
            'bmi' => 'required|string|max:10',
            'initial_assessment_id' => 'required|exists:initial_assessments,id',
        ];
    }
}

