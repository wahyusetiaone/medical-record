<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nik' => 'required|string|max:255',
            'satu_sehat_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'str_number' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'is_active' => 'boolean',
        ];
    }
}
