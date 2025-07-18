<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'patient_id',
        'insurance_type_id',
        'visit_type_id',
        'treatment_type_id',
        'polyclinic_id',
        'doctor_id',
        'responsible_person_id',
        'schedule',
        'path_general_consent',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function insuranceType()
    {
        return $this->belongsTo(InsuranceType::class);
    }
    public function visitType()
    {
        return $this->belongsTo(VisitType::class);
    }
    public function treatmentType()
    {
        return $this->belongsTo(TreatmentType::class);
    }
    public function polyclinic()
    {
        return $this->belongsTo(Polyclinic::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function responsiblePerson()
    {
        return $this->belongsTo(ResponsiblePerson::class);
    }
}
