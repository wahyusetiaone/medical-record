<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResponsiblePersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name' => 'sometimes|required|string|max:255',
            'national_id_number' => 'sometimes|required|string|max:255',
            'date_of_birth' => 'sometimes|required|string|max:255',
            'relationship_to_patient' => 'sometimes|required|string|max:255',
            'gender' => 'sometimes|required|string|max:50',
            'phone_number' => 'sometimes|required|string|max:50',
            'address' => 'sometimes|required|string|max:255',
        ];
    }
}

