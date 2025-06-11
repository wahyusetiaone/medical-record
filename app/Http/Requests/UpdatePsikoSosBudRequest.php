<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePsikoSosBudRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'psychological' => 'sometimes|required|string|max:255',
            'living_with' => 'sometimes|required|string|max:255',
            'daily_language' => 'sometimes|required|string|max:255',
            'patient_id' => 'sometimes|required|exists:patients,id',
        ];
    }
}

