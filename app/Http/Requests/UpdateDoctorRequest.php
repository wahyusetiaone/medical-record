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
            'nik' => 'sometimes|required|string|max:255',
            'satu_sehat_id' => 'sometimes|required|string|max:255',
            'name' => 'sometimes|required|string|max:255',
            'specialty' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'city' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:255',
            'str_number' => 'sometimes|required|string|max:255',
            'start_date' => 'sometimes|required|string|max:255',
            'is_active' => 'boolean',
        ];
    }
}
