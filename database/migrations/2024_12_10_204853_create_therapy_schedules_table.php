<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTherapySchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('therapy_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('therapist_id')->constrained('users');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['available', 'booked', 'unavailable'])->default('available');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('therapy_schedules');
    }
}