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
            'nik' => $this->faker->numerify('################'),
            'satu_sehat_id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'specialty' => $this->faker->randomElement(['Umum', 'Anak', 'Bedah', 'Gigi', 'Mata']),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber(),
            'str_number' => $this->faker->bothify('STR-####-####'),
            'start_date' => $this->faker->date('Y-m-d'),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
