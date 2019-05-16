<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialAlumnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_alumno', function (Blueprint $table) {
            $table->increments('id_historial_alumno');
            $table->integer('id_grupo')-> unsigned() -> nullable();
            $table->foreign('id_grupo')
                  ->references('id_grupo')
                  ->on('cat_grupos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_alumno')-> unsigned() -> nullable();
            $table->foreign('id_alumno')
                  ->references('id_alumno')
                  ->on('alumnos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('narrativa')->nullable();
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
        Schema::dropIfExists('historial_alumno');
    }
}
