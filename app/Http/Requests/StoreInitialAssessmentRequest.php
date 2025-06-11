<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInitialAssessmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'vital_sign_id' => 'nullable|exists:vital_signs,id',
            'healty_data_id' => 'nullable|exists:healty_data,id',
            'physical_measurement_id' => 'nullable|exists:physical_measurements,id',
            'functional_data_id' => 'nullable|exists:functional_data,id',
            'psiko_sos_bud_id' => 'nullable|exists:psiko_sos_bud,id',
            'examination_id' => 'nullable|exists:examinations,id',
            'requare_action_id' => 'nullable|exists:requare_actions,id',
        ];
    }
}

