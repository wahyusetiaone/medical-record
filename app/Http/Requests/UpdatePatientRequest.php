<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // Identity fields
            'identity.full_name' => 'sometimes|required|string|max:255',
            'identity.phone_number' => 'sometimes|nullable|string|max:255',
            'identity.email' => 'sometimes|nullable|email|max:255',
            'identity.gender' => 'sometimes|required|string|max:255',
            'identity.blood_type' => 'sometimes|nullable|string|max:255',
            'identity.born' => 'sometimes|nullable|string|max:255',
            'identity.date_of_birth' => 'sometimes|nullable|date',
            'identity.identity_type' => 'sometimes|required|in:KTP,SIM,KIA,KK',
            'identity.identity_number' => 'sometimes|required|string|max:255',
            'identity.name_of_mother' => 'sometimes|nullable|string|max:255',

            // Address fields
            'address.full_address' => 'sometimes|required|string',
            'address.provincy' => 'sometimes|nullable|string|max:255',
            'address.city' => 'sometimes|nullable|string|max:255',
            'address.district' => 'sometimes|nullable|string|max:255',
            'address.village' => 'sometimes|nullable|string|max:255',
            'address.rt_rw' => 'sometimes|nullable|string|max:255',
            'address.post_code' => 'sometimes|nullable|string|max:255',

            // Social fields
            'social.religion' => 'sometimes|nullable|string|max:255',
            'social.marriage_status' => 'sometimes|nullable|string|max:255',
            'social.education_status' => 'sometimes|nullable|string|max:255',
            'social.work' => 'sometimes|nullable|string|max:255',
            'social.language' => 'sometimes|nullable|string|max:255',
        ];
    }
}
