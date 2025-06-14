<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexClinicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1',
            'search' => 'nullable|string',
        ];
    }
}
