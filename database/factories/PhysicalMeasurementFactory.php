<?php

namespace Database\Factories;

use App\Models\PhysicalMeasurement;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhysicalMeasurementFactory extends Factory
{
    protected $model = PhysicalMeasurement::class;

    public function definition(): array
    {
        $height = $this->faker->numberBetween(150, 190);
        $weight = $this->faker->numberBetween(45, 120);
        $bmi = round($weight / pow($height/100, 2), 1);

        return [
            'height_cm' => (string)$height,
            'weight_kg' => (string)$weight,
            'bmi' => (string)$bmi,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
