<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            'clinic_id' => 'required|exists:clinics,id',
            // Identity fields
            'identity.full_name' => 'required|string|max:255',
            'identity.phone_number' => 'nullable|string|max:255',
            'identity.email' => 'nullable|email|max:255',
            'identity.gender' => 'required|string|max:255',
            'identity.blood_type' => 'nullable|string|max:255',
            'identity.born' => 'nullable|string|max:255',
            'identity.date_of_birth' => 'nullable|date',
            'identity.identity_type' => 'required|in:KTP,SIM,KIA,KK',
            'identity.identity_number' => 'required|string|max:255',
            'identity.name_of_mother' => 'nullable|string|max:255',

            // Address fields
            'address.full_address' => 'required|string',
            'address.provincy' => 'nullable|string|max:255',
            'address.city' => 'nullable|string|max:255',
            'address.district' => 'nullable|string|max:255',
            'address.village' => 'nullable|string|max:255',
            'address.rt_rw' => 'nullable|string|max:255',
            'address.post_code' => 'nullable|string|max:255',

            // Social fields
            'social.religion' => 'nullable|string|max:255',
            'social.marriage_status' => 'nullable|string|max:255',
            'social.education_status' => 'nullable|string|max:255',
            'social.work' => 'nullable|string|max:255',
            'social.language' => 'nullable|string|max:255',
        ];
    }
}
