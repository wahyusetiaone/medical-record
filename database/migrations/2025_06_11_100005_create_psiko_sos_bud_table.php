<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('psiko_sos_buds', function (Blueprint $table) {
            $table->id();
            $table->string('psychological')->nullable();
            $table->string('living_with')->nullable();
            $table->string('daily_language')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('psiko_sos_bud');
    }
};

