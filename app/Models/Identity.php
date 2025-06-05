<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Identity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'gender',
        'blood_type',
        'born',
        'date_of_birth',
        'identity_type',
        'identity_number',
        'name_of_mother',
    ];

    /**
     * Get the patient associated with the identity.
     */
    public function patient(): HasOne
    {
        return $this->hasOne(Patient::class);
    }
}
