<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBreedToBuyerPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyer_preferences', function (Blueprint $table) {
            $table->string('breed')->nullable()->after('prefer_nearby'); // Add breed field after prefer_nearby
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyer_preferences', function (Blueprint $table) {
            $table->dropColumn('breed');
        });
    }
}