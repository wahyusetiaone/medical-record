<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Doctor;
use App\Models\Polyclinic;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = Doctor::all();
        $polyclinics = Polyclinic::all();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        foreach ($doctors as $doctor) {
            foreach ($polyclinics as $polyclinic) {
                foreach (array_slice($days, 0, 2) as $day) {
                    Schedule::factory()->create([
                        'doctor_id' => $doctor->id,
                        'polyclinic_id' => $polyclinic->id,
                        'day_of_week' => $day,
                    ]);
                }
            }
        }
    }
}

