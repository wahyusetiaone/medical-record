<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'clinic_id',
        'doctor_id',
        'polyclinic_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_available',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_time' => 'datetime:H:i:s',
        'end_time' => 'datetime:H:i:s',
        'is_available' => 'boolean',
    ];

    /**
     * Get the doctor that owns the schedule.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get the polyclinic that owns the schedule.
     */
    public function polyclinic(): BelongsTo
    {
        return $this->belongsTo(Polyclinic::class);
    }
}
