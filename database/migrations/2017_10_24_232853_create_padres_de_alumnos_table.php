<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePadresDeAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('padres_de_alumnos', function (Blueprint $table) {
            $table->increments('id_padres_alumno');
            $table->string('nombre');
            $table->string('a_paterno');
            $table->string('a_materno')->nullable();
            $table->string('curp')->unique();
            $table->string('sexo')->nullable();
            $table->string('empleo')->nullable();
            $table->string('puesto')->nullable();
            $table->string('direccion')->nullable();
            $table->string('tel_trabajo')->nullable();
            $table->string('celular')->nullable();
            $table->string('nextel')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('padres_de_alumnos');
    }
}
