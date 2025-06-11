<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsiblePerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'national_id_number',
        'date_of_birth',
        'relationship_to_patient',
        'gender',
        'phone_number',
        'address',
    ];
}

