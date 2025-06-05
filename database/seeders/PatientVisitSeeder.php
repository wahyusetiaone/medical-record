<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PatientVisit;
use App\Models\Patient;
use App\Models\InsuranceType;
use App\Models\VisitType;
use App\Models\TreatmentType;
use App\Models\Polyclinic;
use App\Models\Doctor;

class PatientVisitSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $insuranceTypes = InsuranceType::all();
        $visitTypes = VisitType::all();
        $treatmentTypes = TreatmentType::all();
        $polyclinics = Polyclinic::all();
        $doctors = Doctor::all();

        for ($i = 0; $i < 25; $i++) {
            PatientVisit::factory()->create([
                'patient_id' => $patients->random()->id,
                'insurance_type_id' => $insuranceTypes->random()->id,
                'visit_type_id' => $visitTypes->random()->id,
                'treatment_type_id' => $treatmentTypes->random()->id,
                'polyclinic_id' => $polyclinics->random()->id,
                'doctor_id' => $doctors->random()->id,
            ]);
        }
    }
}

