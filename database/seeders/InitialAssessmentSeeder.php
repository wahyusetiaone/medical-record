<?php

namespace Database\Seeders;

use App\Models\InitialAssessment;
use App\Models\Patient;
use App\Models\VitalSign;
use App\Models\HealtyData;
use App\Models\PhysicalMeasurement;
use App\Models\FunctionalData;
use App\Models\PsikoSosBud;
use App\Models\Examination;
use App\Models\RequareAction;
use Illuminate\Database\Seeder;

class InitialAssessmentSeeder extends Seeder
{
    public function run(): void
    {
        // Create related data first
        $vitalSigns = VitalSign::factory(10)->create();
        $healtyData = HealtyData::factory(10)->create();
        $physicalMeasurements = PhysicalMeasurement::factory(10)->create();
        $functionalData = FunctionalData::factory(10)->create();
        $psikoSosBud = PsikoSosBud::factory(10)->create();
        $examinations = Examination::factory(10)->create();
        $requareActions = RequareAction::factory(10)->create();

        // Get existing patients or create new ones
        $patients = Patient::factory(10)->create();

        // Create Initial Assessments
        foreach ($patients as $index => $patient) {
            InitialAssessment::create([
                'patient_id' => $patient->id,
                'vital_sign_id' => $vitalSigns[$index]->id,
                'healty_data_id' => $healtyData[$index]->id,
                'physical_measurement_id' => $physicalMeasurements[$index]->id,
                'functional_data_id' => $functionalData[$index]->id,
                'psiko_sos_bud_id' => $psikoSosBud[$index]->id,
                'examination_id' => $examinations[$index]->id,
                'requare_action_id' => $requareActions[$index]->id,
            ]);
        }
    }
}
