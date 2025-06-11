<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('physical_measurements', function (Blueprint $table) {
            $table->id();
            $table->string('height_cm')->nullable();
            $table->string('weight_kg')->nullable();
            $table->string('bmi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('physical_measurements');
    }
};

