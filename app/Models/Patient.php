<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'clinic_id',
        'identity_id',
        'address_id',
        'social_id',
    ];

    /**
     * Get the identity associated with the patient.
     */
    public function identity(): BelongsTo
    {
        return $this->belongsTo(Identity::class);
    }

    /**
     * Get the address associated with the patient.
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Get the social information associated with the patient.
     */
    public function social(): BelongsTo
    {
        return $this->belongsTo(Social::class);
    }
}
