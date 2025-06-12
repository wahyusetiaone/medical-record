<?php

namespace Database\Factories;

use App\Models\HealtyData;
use Illuminate\Database\Eloquent\Factories\Factory;

class HealtyDataFactory extends Factory
{
    protected $model = HealtyData::class;

    public function definition(): array
    {
        return [
            'main_complaint' => $this->faker->sentence(),
            'illness_history' => $this->faker->paragraph(),
            'family_disease_history' => $this->faker->paragraph(),
            'allergy_history' => $this->faker->optional()->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
