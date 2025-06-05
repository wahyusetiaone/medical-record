<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Polyclinic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'floor',
        'room_number',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'floor' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get the schedules for the polyclinic.
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
