<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitialAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'vital_sign_id',
        'healty_data_id',
        'physical_measurement_id',
        'functional_data_id',
        'psiko_sos_bud_id',
        'examination_id',
        'requare_action_id',
    ];

    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function vitalSign()
    {
        return $this->belongsTo(VitalSign::class);
    }
    public function healtyData()
    {
        return $this->belongsTo(HealtyData::class);
    }
    public function physicalMeasurement()
    {
        return $this->belongsTo(PhysicalMeasurement::class);
    }
    public function functionalData()
    {
        return $this->belongsTo(FunctionalData::class);
    }
    public function psikoSosBud()
    {
        return $this->belongsTo(PsikoSosBud::class);
    }
    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }
    public function requareAction()
    {
        return $this->belongsTo(RequareAction::class);
    }
}
