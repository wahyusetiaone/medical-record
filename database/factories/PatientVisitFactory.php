<?php

namespace Database\Factories;

use App\Models\PatientVisit;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientVisitFactory extends Factory
{
    protected $model = PatientVisit::class;

    public function definition(): array
    {
        return [
            'patient_id' => null, // Set in seeder
            'insurance_type_id' => null, // Set in seeder
            'visit_type_id' => null, // Set in seeder
            'treatment_type_id' => null, // Set in seeder
            'polyclinic_id' => null, // Set in seeder
            'doctor_id' => null, // Set in seeder
            'schedule' => $this->faker->date(),
            'path_general_consent' => $this->faker->optional()->filePath(),
        ];
    }
}
