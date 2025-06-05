<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TreatmentType;

class TreatmentTypeSeeder extends Seeder
{
    public function run(): void
    {
        TreatmentType::factory()->count(5)->create();
    }
}

