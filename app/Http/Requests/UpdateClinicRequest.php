<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClinicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'branch_id' => 'sometimes|required|integer|exists:branches,id',
            'organization_id' => 'sometimes|required|integer|exists:organizations,id',
            'name' => 'sometimes|required|string|max:255',
        ];
    }
}
