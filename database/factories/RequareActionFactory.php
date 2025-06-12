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
            'action_type' => $this->faker->randomElement(['Medication', 'Lab Test', 'Procedure', 'Referral', 'Follow-up']),
            'description' => $this->faker->text(),
            'priority' => $this->faker->randomElement(['High', 'Medium', 'Low']),
            'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
