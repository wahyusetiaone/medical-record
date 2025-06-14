<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medical_staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id')->constrained('clinics');
            $table->string('nama');
            $table->boolean('is_medical_staff')->default(true);
            $table->string('division');
            $table->date('start_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_staff');
    }
};
