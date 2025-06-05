<?php

namespace Database\Factories;

use App\Models\VisitType;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitTypeFactory extends Factory
{
    protected $model = VisitType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' Visit',
            'description' => $this->faker->optional()->sentence(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}

