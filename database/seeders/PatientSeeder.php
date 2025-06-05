<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Identity;
use App\Models\Address;
use App\Models\Social;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 25; $i++) {
            $identity = Identity::inRandomOrder()->first() ?? Identity::factory()->create();
            $address = Address::inRandomOrder()->first() ?? Address::factory()->create();
            $social = Social::inRandomOrder()->first() ?? Social::factory()->create();
            Patient::factory()->create([
                'identity_id' => $identity->id,
                'address_id' => $address->id,
                'social_id' => $social->id,
            ]);
        }
    }
}

