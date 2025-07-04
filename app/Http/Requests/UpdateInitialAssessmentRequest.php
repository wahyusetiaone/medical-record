<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInitialAssessmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'patient_visit_id' => 'sometimes|required|exists:patient_visits,id',
            'vital_sign_id' => 'sometimes|nullable|exists:vital_signs,id',
            'healty_data_id' => 'sometimes|nullable|exists:healty_data,id',
            'physical_measurement_id' => 'sometimes|nullable|exists:physical_measurements,id',
            'functional_data_id' => 'sometimes|nullable|exists:functional_data,id',
            'psiko_sos_bud_id' => 'sometimes|nullable|exists:psiko_sos_bud,id',
            'examination_id' => 'sometimes|nullable|exists:examinations,id',
            'requare_action_id' => 'sometimes|nullable|exists:requare_actions,id',
        ];
    }
}

