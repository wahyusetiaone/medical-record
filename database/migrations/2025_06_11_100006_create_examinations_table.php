<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();
            $table->string('consciousness')->nullable();
            $table->string('respiration')->nullable();
            $table->string('get_up_and_go_test')->nullable();
            $table->string('fall_risk')->nullable();
            $table->string('pain_scale')->nullable();
            $table->string('cough')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examinations');
    }
};

