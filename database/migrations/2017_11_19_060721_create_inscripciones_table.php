<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->increments('id_inscripcion');
            $table->integer('id_periodo')->nullable()->unsigned();
            $table->foreign('id_periodo')
                  ->references('id_periodo')
                  ->on('cat_periodos')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
            $table->integer('id_grupo')->nullable()->unsigned();
            $table->foreign('id_grupo')
                  ->references('id_grupo')
                  ->on('materia_x_grupos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_materia')->nullable()->unsigned();
            $table->foreign('id_materia')
                  ->references('id_materia')
                  ->on('materia_x_grupos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_alumno')->nullable()->unsigned();
            $table->foreign('id_alumno')
                  ->references('id_alumno')
                  ->on('alumnos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->smallInteger('bimestre_trimestre')->nullable()->default(0);
            $table->float('examen')->nullable()->default(0);
            $table->float('tareas')->nullable()->default(0);
            $table->float('trabajos')->nullable()->default(0);
            $table->smallInteger('asistencias')->nullable()->default(0);
            $table->float('puntos_extra')->nullable()->default(0);
            $table->float('examen_extra')->nullable()->default(0);
            $table->smallInteger('numero_inasistencias')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripciones');
    }
}
