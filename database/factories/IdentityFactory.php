<?php

namespace Database\Factories;

use App\Models\Identity;
use Illuminate\Database\Eloquent\Factories\Factory;

class IdentityFactory extends Factory
{
    protected $model = Identity::class;

    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'blood_type' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'born' => $this->faker->city(),
            'date_of_birth' => $this->faker->date('Y-m-d'),
            'identity_type' => $this->faker->randomElement(['KTP', 'SIM', 'Passport']),
            'identity_number' => $this->faker->unique()->numerify('################'),
            'name_of_mother' => $this->faker->firstNameFemale(),
        ];
    }
}
