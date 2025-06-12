<?php

namespace Database\Factories;

use App\Models\Examination;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExaminationFactory extends Factory
{
    protected $model = Examination::class;

    public function definition(): array
    {
        return [
            'consciousness' => $this->faker->randomElement(['Alert', 'Voice', 'Pain', 'Unresponsive']),
            'respiration' => $this->faker->randomElement(['Normal', 'Dyspnea', 'Tachypnea', 'Bradypnea']),
            'get_up_and_go_test' => $this->faker->randomElement(['Normal', 'Slight Abnormality', 'Mild Abnormality', 'Moderate', 'Severe']),
            'fall_risk' => $this->faker->randomElement(['Low', 'Moderate', 'High']),
            'pain_scale' => $this->faker->numberBetween(0, 10),
            'cough' => $this->faker->randomElement(['None', 'Dry', 'Productive']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
