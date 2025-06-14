<?php

namespace App\Observers;

use App\Models\PatientVisit;
use App\Models\InitialAssessment;

class PatientVisitObserver
{
    protected function handleInitialAssessment(PatientVisit $patientVisit)
    {
        if ($patientVisit->path_general_consent !== null) {
            $exists = InitialAssessment::where('patient_visit_id', $patientVisit->id)->exists();

            if (!$exists) {
                InitialAssessment::create([
                    'clinic_id' => $patientVisit->clinic_id,
                    'patient_visit_id' => $patientVisit->id,
                ]);
            }
        }
    }

    public function created(PatientVisit $patientVisit)
    {
        $this->handleInitialAssessment($patientVisit);
    }

    public function updated(PatientVisit $patientVisit)
    {
        $this->handleInitialAssessment($patientVisit);
    }
}
