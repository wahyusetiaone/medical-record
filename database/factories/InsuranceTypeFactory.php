<?php

namespace Database\Factories;

use App\Models\InsuranceType;
use Illuminate\Database\Eloquent\Factories\Factory;

class InsuranceTypeFactory extends Factory
{
    protected $model = InsuranceType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->optional()->sentence(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}

