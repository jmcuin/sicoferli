<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropEscolaridadAndPeriodoFromInscripciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inscripciones', function (Blueprint $table) {
            //
            $table -> dropForeign('inscripciones_id_escolaridad_foreign');
            $table -> dropColumn('id_escolaridad');
            $table -> dropForeign('inscripciones_id_periodo_foreign');
            $table -> dropColumn('id_periodo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inscripciones', function (Blueprint $table) {
            //
        });
    }
}
