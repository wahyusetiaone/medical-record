<?php

namespace Database\Factories;

use App\Models\Social;
use Illuminate\Database\Eloquent\Factories\Factory;

class SocialFactory extends Factory
{
    protected $model = Social::class;

    public function definition(): array
    {
        return [
            'religion' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'work' => $this->faker->jobTitle(),
        ];
    }
}

