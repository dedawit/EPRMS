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
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('details');
            $table->string('blood_pressure');
            $table->string('medicine');
            $table->float('weight');
            $table->float('temperature');
            $table->integer('heart_rate');
            $table->boolean('treatment_variable');
            $table->foreignId('doctor_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_histories');
    }
};
