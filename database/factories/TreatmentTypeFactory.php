<?php

namespace Database\Factories;

use App\Models\TreatmentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TreatmentTypeFactory extends Factory
{
    protected $model = TreatmentType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' Treatment',
            'category' => $this->faker->randomElement(['inpatient', 'outpatient', 'emergency']),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}

