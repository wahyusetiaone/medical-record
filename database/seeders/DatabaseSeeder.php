<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AddressSeeder::class,
            IdentitySeeder::class,
            SocialSeeder::class,
            InsuranceTypeSeeder::class,
            VisitTypeSeeder::class,
            TreatmentTypeSeeder::class,
            PolyclinicSeeder::class,
            DoctorSeeder::class,
            PatientSeeder::class,
            ScheduleSeeder::class,
            PatientVisitSeeder::class,
            ChiefComplaintSeeder::class,
            InitialAssessmentSeeder::class,
        ]);
    }
}

