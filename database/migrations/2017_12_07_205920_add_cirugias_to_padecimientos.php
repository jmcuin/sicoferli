<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCirugiasToPadecimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('padecimientos', function (Blueprint $table) {
            //
            $table->string('cirugia')->nullable()->after('enfermedad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('padecimientos', function (Blueprint $table) {
            //
            $table->dropColumn('cirugia');
        });
    }
}
