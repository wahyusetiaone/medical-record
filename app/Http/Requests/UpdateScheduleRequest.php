<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'doctor_id' => 'sometimes|required|exists:doctors,id',
            'polyclinic_id' => 'sometimes|required|exists:polyclinics,id',
            'day_of_week' => 'sometimes|required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'sometimes|required|date_format:H:i:s',
            'end_time' => 'sometimes|required|date_format:H:i:s|after:start_time',
            'is_available' => 'boolean',
        ];
    }
}

