<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionalData extends Model
{
    use HasFactory;

    protected $fillable = [
        'assistive_device',
        'physical_disability',
        'daily_activity',
        'note',
    ];

    public function initialAssessment()
    {
        return $this->hasOne(InitialAssessment::class, 'functional_data_id');
    }
}
