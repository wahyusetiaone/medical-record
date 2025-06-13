<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsikoSosBud extends Model
{
    use HasFactory;
    protected $table = 'psiko_sos_buds';

    protected $fillable = [
        'psychological',
        'living_with',
        'daily_language',
    ];

    public function initialAssessment()
    {
        return $this->hasOne(InitialAssessment::class, 'psiko_sos_bud_id');
    }
}
