<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexDoctorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'page' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1|max:100',
            'search' => 'nullable|string|max:255',
        ];
    }
}

