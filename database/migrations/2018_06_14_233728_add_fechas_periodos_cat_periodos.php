<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFechasPeriodosCatPeriodos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_periodos', function (Blueprint $table) {
            //
            $table->date('inicio')->nullable()->after('bimestre_secundaria');
            $table->date('termino')->nullable()->after('inicio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cat_periodos', function (Blueprint $table) {
            //
            $table -> dropColumn('inicio');
            $table -> dropColumn('termino');
        });
    }
}
