<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalStaff extends Model
{
    use HasFactory;

    protected $table = 'medical_staff';

    protected $fillable = [
        'clinic_id',
        'nama',
        'is_medical_staff',
        'division',
        'start_date'
    ];

    protected $casts = [
        'is_medical_staff' => 'boolean',
        'start_date' => 'date'
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
