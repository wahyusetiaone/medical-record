<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Polyclinic;

class PolyclinicSeeder extends Seeder
{
    public function run(): void
    {
        Polyclinic::factory()->count(5)->create();
    }
}

