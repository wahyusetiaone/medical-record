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
            $table->text('main_complaint')->nullable();
            $table->text('anamnesis')->nullable();
            $table->text('disease_history')->nullable();
            $table->text('drug_allergy_history')->nullable();
            $table->text('other_allergy_history')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('healty_data');
    }
};

