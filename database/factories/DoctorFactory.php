<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'specialty' => $this->faker->randomElement(['Umum', 'Anak', 'Bedah', 'Gigi', 'Mata']),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}

