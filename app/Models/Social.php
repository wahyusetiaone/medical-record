<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Social extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'religion',
        'marriage_status',
        'education_status',
        'work',
        'language',
    ];

    /**
     * Get the patient associated with the social information.
     */
    public function patient(): HasOne
    {
        return $this->hasOne(Patient::class);
    }
}
