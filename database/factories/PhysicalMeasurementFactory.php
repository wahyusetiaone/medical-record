<?php

namespace Database\Factories;

use App\Models\PhysicalMeasurement;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhysicalMeasurementFactory extends Factory
{
    protected $model = PhysicalMeasurement::class;

    public function definition(): array
    {
        return [
            'weight' => $this->faker->randomFloat(1, 45, 120),
            'height' => $this->faker->randomFloat(1, 150, 190),
            'bmi' => $this->faker->randomFloat(1, 18.5, 30),
            'head_circumference' => $this->faker->randomFloat(1, 50, 60),
            'arm_circumference' => $this->faker->randomFloat(1, 20, 35),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
