<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InsuranceType;

class InsuranceTypeSeeder extends Seeder
{
    public function run(): void
    {
        InsuranceType::factory()->count(5)->create();
    }
}

