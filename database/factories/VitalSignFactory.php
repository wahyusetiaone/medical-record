<?php

namespace Database\Factories;

use App\Models\VitalSign;
use Illuminate\Database\Eloquent\Factories\Factory;

class VitalSignFactory extends Factory
{
    protected $model = VitalSign::class;

    public function definition(): array
    {
        return [
            'blood_pressure' => $this->faker->numberBetween(90, 140) . '/' . $this->faker->numberBetween(60, 90),
            'heart_rate' => $this->faker->numberBetween(60, 100),
            'respiratory_rate' => $this->faker->numberBetween(12, 20),
            'body_temperature' => $this->faker->randomFloat(1, 36.1, 37.5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
