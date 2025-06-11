<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('functional_data', function (Blueprint $table) {
            $table->id();
            $table->boolean('assistive_device')->nullable();
            $table->boolean('physical_disability')->nullable();
            $table->string('daily_activity')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('functional_data');
    }
};

