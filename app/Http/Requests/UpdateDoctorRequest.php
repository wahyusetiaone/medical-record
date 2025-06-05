<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'specialty' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:doctors,email,' . $this->route('doctor'),
            'is_active' => 'boolean',
        ];
    }
}

