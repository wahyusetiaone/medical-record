<?php

namespace Database\Factories;

use App\Models\Polyclinic;
use Illuminate\Database\Eloquent\Factories\Factory;

class PolyclinicFactory extends Factory
{
    protected $model = Polyclinic::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company() . ' Clinic',
            'floor' => $this->faker->numberBetween(1, 5),
            'room_number' => $this->faker->numerify('###'),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}

