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
        Schema::create('pigfarminformation', function (Blueprint $table) {
            $table->id('pigfarmId');
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('feeding type');
            $table->string('frequency');
            $table->string('minimumPricePerKilo');
            $table->string('maximumPricePerKilo');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
