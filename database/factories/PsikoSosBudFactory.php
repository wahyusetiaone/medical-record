<?php

namespace Database\Factories;

use App\Models\PsikoSosBud;
use Illuminate\Database\Eloquent\Factories\Factory;

class PsikoSosBudFactory extends Factory
{
    protected $model = PsikoSosBud::class;

    public function definition(): array
    {
        return [
            'psychological_condition' => $this->faker->randomElement(['Stable', 'Anxious', 'Depressed', 'Agitated']),
            'social_support' => $this->faker->randomElement(['Strong', 'Moderate', 'Limited', 'None']),
            'cultural_considerations' => $this->faker->text(),
            'spiritual_needs' => $this->faker->optional()->text(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
