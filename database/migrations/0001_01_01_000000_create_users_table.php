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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('email')->unique();
            $table->string('first_name');
                $table->string('father_name');
                $table->string('grand_father_name');
                $table->string('password')->nullable();
                $table->enum('gender', ['M', 'F']);
                $table->date('date_of_birth');
                $table->string('region');
                $table->string('zone');
                $table->string('woreda');
                $table->string('ketena');
                $table->string('kebele');
                $table->integer('house_number');
                $table->string('phone');
                $table->string('emergency_name');
                $table->string('emergency_phone');
                $table->boolean('position')->nullable();
                $table->string('profile')->nullable();

                $table->string('role')->nullable();
                $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
