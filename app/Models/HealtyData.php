<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealtyData extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_pregnant_or_breastfeeding',
        'smoker_status',
        'main_complaint',
        'anamnesis',
        'disease_history',
        'drug_allergy_history',
        'other_allergy_history',
    ];

    public function initialAssessment()
    {
        return $this->hasOne(InitialAssessment::class, 'healty_data_id');
    }
}
