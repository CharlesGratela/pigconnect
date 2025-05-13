<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerPreferencesTable extends Migration
{
    public function up()
    {
        Schema::create('buyer_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('preferred_weight')->nullable();
            $table->string('age_of_pigs')->nullable();
            $table->string('price_range')->nullable();
            $table->boolean('prefer_nearby')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buyer_preferences');
    }
}