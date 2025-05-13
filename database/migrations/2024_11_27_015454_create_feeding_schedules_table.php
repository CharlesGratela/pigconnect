<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedingSchedulesTable extends Migration
{
    public function up(): void
    {
        Schema::create('feeding_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->json('feeding_times');
            $table->timestamps();

  });
    }

    public function down(): void
    {
        Schema::dropIfExists('feeding_schedules');
    }
}