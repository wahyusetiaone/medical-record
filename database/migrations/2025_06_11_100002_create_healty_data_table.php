<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('healty_data', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_pregnant_or_breastfeeding')->nullable();
            $table->boolean('smoker_status')->nullable();
            $table->string('main_complaint')->nullable();
            $table->string('anamnesis')->nullable();
            $table->string('disease_history')->nullable();
            $table->string('drug_allergy_history')->nullable();
            $table->string('other_allergy_history')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('healty_data');
    }
};

