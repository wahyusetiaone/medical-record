<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_address',
        'provincy',
        'city',
        'district',
        'village',
        'rt_rw',
        'post_code',
    ];

    /**
     * Get the patient associated with the address.
     */
    public function patient(): HasOne
    {
        return $this->hasOne(Patient::class);
    }
}
