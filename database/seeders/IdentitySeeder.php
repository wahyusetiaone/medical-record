<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Identity;

class IdentitySeeder extends Seeder
{
    public function run(): void
    {
        Identity::factory()->count(5)->create();
    }
}

