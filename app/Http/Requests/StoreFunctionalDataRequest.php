<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFunctionalDataRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'assistive_device' => 'required|boolean',
            'physical_disability' => 'required|boolean',
            'daily_activity' => 'required|string|max:255',
            'note' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
        ];
    }
}

