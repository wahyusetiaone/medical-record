<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $fillable = [
        'consciousness',
        'respiration',
        'get_up_and_go_test',
        'fall_risk',
        'pain_scale',
        'cough',
    ];

    public function initialAssessment()
    {
        return $this->hasOne(InitialAssessment::class, 'examination_id');
    }
}
