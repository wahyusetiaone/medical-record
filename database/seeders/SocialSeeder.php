<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Social;

class SocialSeeder extends Seeder
{
    public function run(): void
    {
        Social::factory()->count(5)->create();
    }
}

