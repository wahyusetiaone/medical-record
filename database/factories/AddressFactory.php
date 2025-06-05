<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'full_address' => $this->faker->address(),
            'provincy' => $this->faker->state(),
            'city' => $this->faker->city(),
            'district' => $this->faker->citySuffix(),
            'village' => $this->faker->streetName(),
            'rt_rw' => $this->faker->numberBetween(1, 20) . '/' . $this->faker->numberBetween(1, 20),
            'post_code' => $this->faker->postcode(),
        ];
    }
}

