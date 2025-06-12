<?php

namespace Database\Factories;

use App\Models\RequareAction;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequareActionFactory extends Factory
{
    protected $model = RequareAction::class;

    public function definition(): array
    {
        return [
            'polyclinic_by_queue' => $this->faker->boolean(),
            'prioritized_polyclinic' => $this->faker->boolean(),
            'igd' => $this->faker->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
