<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePolyclinicRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'clinic_id' => 'required|exists:clinics,id',
            'name' => 'required|string|max:255',
            'floor' => 'required|integer',
            'room_number' => 'required|string|max:255',
            'is_active' => 'boolean',
        ];
    }
}

