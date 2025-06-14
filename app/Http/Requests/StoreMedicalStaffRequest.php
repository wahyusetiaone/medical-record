<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalStaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'clinic_id' => 'required|integer|exists:clinics,id',
            'nama' => 'required|string|max:255',
            'is_medical_staff' => 'required|boolean',
            'division' => 'required|string|max:255',
            'start_date' => 'required|date',
        ];
    }
}
