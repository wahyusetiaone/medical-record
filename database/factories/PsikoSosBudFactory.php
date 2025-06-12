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
            'psychological' => $this->faker->randomElement(['Cooperative', 'Anxious', 'Depressed', 'Aggressive']),
            'living_with' => $this->faker->randomElement(['Family', 'Alone', 'Caregiver', 'Others']),
            'daily_language' => $this->faker->randomElement(['Indonesian', 'Javanese', 'Sundanese', 'English', 'Others']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
