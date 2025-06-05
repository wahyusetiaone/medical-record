<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitType;

class VisitTypeSeeder extends Seeder
{
    public function run(): void
    {
        VisitType::factory()->count(5)->create();
    }
}

