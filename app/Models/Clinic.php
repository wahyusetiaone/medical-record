<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'organization_id',
        'name'
    ];

    public function medicalStaff()
    {
        return $this->hasMany(MedicalStaff::class);
    }
}
