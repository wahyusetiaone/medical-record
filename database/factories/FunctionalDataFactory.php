<?php

namespace Database\Factories;

use App\Models\FunctionalData;
use Illuminate\Database\Eloquent\Factories\Factory;

class FunctionalDataFactory extends Factory
{
    protected $model = FunctionalData::class;

    public function definition(): array
    {
        return [
            'activity_level' => $this->faker->randomElement(['Independent', 'Partially Dependent', 'Fully Dependent']),
            'mobility' => $this->faker->randomElement(['Mobile', 'Limited Mobility', 'Immobile']),
            'fall_risk' => $this->faker->boolean(),
            'cognitive_function' => $this->faker->randomElement(['Normal', 'Mild Impairment', 'Moderate Impairment', 'Severe Impairment']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
