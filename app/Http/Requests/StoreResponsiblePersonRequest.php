<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResponsiblePersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'national_id_number' => 'required|string|max:255',
            'date_of_birth' => 'required|string|max:255',
            'relationship_to_patient' => 'required|string|max:255',
            'gender' => 'required|string|max:50',
            'phone_number' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'patient_visit_id' => 'required|exists:patient_visits,id',
        ];
    }
}
