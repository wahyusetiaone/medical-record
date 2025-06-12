<?php

namespace Database\Seeders;

use App\Models\InitialAssessment;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\VitalSign;
use App\Models\HealtyData;
use App\Models\PhysicalMeasurement;
use App\Models\FunctionalData;
use App\Models\PsikoSosBud;
use App\Models\Examination;
use App\Models\RequareAction;
use App\Models\Identity;
use App\Models\Address;
use App\Models\Social;
use Illuminate\Database\Seeder;

class InitialAssessmentSeeder extends Seeder
{
    public function run(): void
    {
//        get patient visit id 1 -10
        $patient_visits = PatientVisit::limit(10)->get();

        // Create related assessment data
        $vitalSigns = VitalSign::factory(10)->create();
        $healtyData = HealtyData::factory(10)->create();
        $physicalMeasurements = PhysicalMeasurement::factory(10)->create();
        $functionalData = FunctionalData::factory(10)->create();
        $psikoSosBud = PsikoSosBud::factory(10)->create();
        $examinations = Examination::factory(10)->create();
        $requareActions = RequareAction::factory(10)->create();

        // Create Initial Assessments
        foreach ($patient_visits as $index => $patient_visit) {
            InitialAssessment::create([
                'patient_visit_id' => $patient_visit->id,
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
