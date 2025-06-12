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
            'assistive_device' => $this->faker->boolean(),
            'physical_disability' => $this->faker->boolean(),
            'daily_activity' => $this->faker->randomElement(['Independent', 'Need Help', 'Dependent']),
            'note' => $this->faker->optional()->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
