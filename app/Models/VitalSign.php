<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitalSign extends Model
{
    use HasFactory;

    protected $fillable = [
        'body_temperature',
        'pulse',
        'systolic',
        'diastolic',
        'respiratory_rate',
    ];

    public function initialAssessment()
    {
        return $this->hasOne(InitialAssessment::class, 'vital_sign_id');
    }
}
