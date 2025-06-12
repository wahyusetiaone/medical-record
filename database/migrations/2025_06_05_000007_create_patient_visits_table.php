<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('insurance_type_id')->nullable()->constrained('insurance_types')->onDelete('set null');
            $table->foreignId('visit_type_id')->nullable()->constrained('visit_types')->onDelete('set null');
            $table->foreignId('treatment_type_id')->nullable()->constrained('treatment_types')->onDelete('set null');
            $table->foreignId('polyclinic_id')->nullable()->constrained('polyclinics')->onDelete('set null');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors')->onDelete('set null');
            $table->foreignId('responsible_person_id')->nullable()->constrained('responsible_people')->onDelete('set null');
            $table->date('schedule')->nullable();
            $table->string('path_general_consent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_visits');
    }
};
