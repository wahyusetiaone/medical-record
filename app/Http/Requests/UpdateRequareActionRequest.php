<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequareActionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'polyclinic_by_queue' => 'sometimes|required|boolean',
            'prioritized_polyclinic' => 'sometimes|required|boolean',
            'igd' => 'sometimes|required|boolean',
            'patient_id' => 'sometimes|required|exists:patients,id',
        ];
    }
}

