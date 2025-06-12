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
            'physical_examination' => $this->faker->text(),
            'laboratory_results' => $this->faker->optional()->text(),
            'diagnosis' => $this->faker->words(3, true),
            'notes' => $this->faker->optional()->text(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
