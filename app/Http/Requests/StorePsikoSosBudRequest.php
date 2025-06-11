<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePsikoSosBudRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'psychological' => 'required|string|max:255',
            'living_with' => 'required|string|max:255',
            'daily_language' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
        ];
    }
}

