<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalMeasurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'height_cm',
        'weight_kg',
        'bmi',
    ];

    public function initialAssessment()
    {
        return $this->hasOne(InitialAssessment::class, 'physical_measurement_id');
    }
}
