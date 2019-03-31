<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTomasClaseYParticipacionInscripciones extends Migration
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
            $table->float('tomas_clase')->nullable()->default(0)->after('tareas');
            $table->float('participacion')->nullable()->default(0)->after('tomas_clase');
            $table->integer('id_criterio_desempenio')->unsigned() -> nullable() -> after('id_alumno');
            $table->foreign('id_criterio_desempenio')
                  ->references('id_criterio_desempenio')
                  ->on('cat_criterios_desempenio')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
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
            $table -> dropColumn('tomas_clase');
            $table -> dropColumn('participacion');
        });
    }
}
