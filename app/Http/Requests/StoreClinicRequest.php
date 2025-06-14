<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClinicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'branch_id' => 'required|integer|exists:branches,id',
            'organization_id' => 'required|integer|exists:organizations,id',
            'name' => 'required|string|max:255',
        ];
    }
}
