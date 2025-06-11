<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('initial_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('vital_sign_id')->nullable()->constrained('vital_signs')->onDelete('set null');
            $table->foreignId('healty_data_id')->nullable()->constrained('healty_data')->onDelete('set null');
            $table->foreignId('physical_measurement_id')->nullable()->constrained('physical_measurements')->onDelete('set null');
            $table->foreignId('functional_data_id')->nullable()->constrained('functional_data')->onDelete('set null');
            $table->foreignId('psiko_sos_bud_id')->nullable()->constrained('psiko_sos_bud')->onDelete('set null');
            $table->foreignId('examination_id')->nullable()->constrained('examinations')->onDelete('set null');
            $table->foreignId('requare_action_id')->nullable()->constrained('requare_actions')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('initial_assessments');
    }
};

