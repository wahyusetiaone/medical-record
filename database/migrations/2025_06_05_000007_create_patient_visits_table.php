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
            $table->foreignId('insurance_type_id')->constrained('insurance_types')->onDelete('restrict');
            $table->foreignId('visit_type_id')->constrained('visit_types')->onDelete('restrict');
            $table->foreignId('treatment_type_id')->constrained('treatment_types')->onDelete('restrict');
            $table->foreignId('polyclinic_id')->constrained('polyclinics')->onDelete('restrict');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('restrict');
            $table->date('schedule');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_visits');
    }
};

