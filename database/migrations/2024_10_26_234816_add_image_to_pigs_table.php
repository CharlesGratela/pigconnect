<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToPigsTable extends Migration
{
    public function up()
    {
        Schema::table('pigs', function (Blueprint $table) {
            $table->string('image')->after('status');
            $table->decimal('price_per_kilo', 8, 2)->after('status');
            $table->string('mark')->nullable()->after('status');
            $table->string('breed')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('pigs', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
} 