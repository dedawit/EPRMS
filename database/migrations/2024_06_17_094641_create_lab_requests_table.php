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
        Schema::create('lab_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('test_type');
            $table->string('result')->nullable();

            $table->foreignId('laboratory_id')->constrained('users')->cascadeOnDelete()->nullable();
            $table->foreignId('history_id')->constrained('medical_histories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_requests');
    }
};
