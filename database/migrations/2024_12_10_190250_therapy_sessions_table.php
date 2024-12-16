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
        Schema::create('therapy_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Links to the users table
            $table->foreignId('therapist_id')->constrained('users'); // Links to the users table
            $table->foreignId('therapy_schedule_id')->constrained('therapy_schedules'); // Links to the therapy_schedules table
            $table->boolean('is_paid')->default(false); // Add is_paid column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('therapy_sessions');
    }
};