<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition(): array
    {
        return [
            'identity_id' => null, // Set in seeder
            'address_id' => null,  // Set in seeder
            'social_id' => null,   // Set in seeder
        ];
    }
}

