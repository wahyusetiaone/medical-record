<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequareAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'polyclinic_by_queue',
        'prioritized_polyclinic',
        'igd',
    ];

    public function initialAssessment()
    {
        return $this->hasOne(InitialAssessment::class, 'requare_action_id');
    }
}
