<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePolyclinicRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'floor' => 'sometimes|required|integer',
            'room_number' => 'sometimes|required|string|max:255',
            'is_active' => 'boolean',
        ];
    }
}

