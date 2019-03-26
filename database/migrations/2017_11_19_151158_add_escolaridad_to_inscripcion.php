<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEscolaridadToInscripcion extends Migration
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
            $table->integer('id_escolaridad')->after('id_inscripcion')->nullable()->unsigned();
            $table->foreign('id_escolaridad')
                  ->references('id_escolaridad')
                  ->on('cat_escolaridads')
                  ->onDelete('set null')
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
            $table->dropColumn('id_escolaridad');
        });
    }
}
