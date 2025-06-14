<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicalStaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'clinic_id' => 'sometimes|required|integer|exists:clinics,id',
            'nama' => 'sometimes|required|string|max:255',
            'is_medical_staff' => 'sometimes|required|boolean',
            'division' => 'sometimes|required|string|max:255',
            'start_date' => 'sometimes|required|date',
        ];
    }
}
