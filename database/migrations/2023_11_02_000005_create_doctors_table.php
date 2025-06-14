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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id')->constrained('clinics');
            $table->string('name');
            $table->string('specialty');
            $table->string('phone');
            $table->boolean('is_active')->default(true);
            $table->string('nik', 16);               // Adding nik column
            $table->string('satu_sehat_id');         // Adding satu_sehat_id column
            $table->text('address');                 // Changed to text for longer addresses
            $table->string('city');
            $table->string('str_number');
            $table->date('start_date');              // Changed to date type
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
