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
            'is_pregnant_or_breastfeeding' => $this->faker->boolean(),
            'smoker_status' => $this->faker->boolean(),
            'main_complaint' => $this->faker->sentence(),
            'anamnesis' => $this->faker->paragraph(),
            'disease_history' => $this->faker->paragraph(),
            'drug_allergy_history' => $this->faker->optional()->sentence(),
            'other_allergy_history' => $this->faker->optional()->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
