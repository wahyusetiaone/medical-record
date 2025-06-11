<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequareActionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'polyclinic_by_queue' => 'required|boolean',
            'prioritized_polyclinic' => 'required|boolean',
            'igd' => 'required|boolean',
            'patient_id' => 'required|exists:patients,id',
        ];
    }
}

