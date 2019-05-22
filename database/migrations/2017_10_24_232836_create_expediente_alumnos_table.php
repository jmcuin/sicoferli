<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedienteAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expediente_alumnos', function (Blueprint $table) {
            $table->increments('id_expediente');
            $table->integer('id_alumno')->unsigned();
            $table->foreign('id_alumno')
                  ->references('id_alumno')
                  ->on('alumnos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->tinyInteger('acta_nacimiento');
            $table->string('obs_acta')->nullable();
            $table->tinyInteger('curp');
            $table->string('obs_curp')->nullable();
            $table->tinyInteger('cartilla_vacunacion');
            $table->string('obs_cartilla')->nullable();
            $table->tinyInteger('certificado_medico');
            $table->string('obs_cert_medico')->nullable();
            $table->tinyInteger('constancia_estudios');
            $table->string('obs_constancia')->nullable();
            $table->tinyInteger('curp_padre');
            $table->string('obs_curp_padre')->nullable();
            $table->tinyInteger('curp_madre');
            $table->string('obs_curp_madre')->nullable();
            $table->tinyInteger('ife_padre');
            $table->string('obs_ife_padre')->nullable();
            $table->tinyInteger('ife_madre');
            $table->string('obs_ife_madre')->nullable();
            $table->tinyInteger('comp_domicilio');
            $table->string('obs_comp_domicilio')->nullable();
            $table->tinyInteger('boleta_anterior');
            $table->string('obs_boleta_anterior')->nullable();
            $table->tinyInteger('carta_conducta');
            $table->string('obs_carta_conducta')->nullable();
            $table->tinyInteger('cert_primaria');
            $table->string('obs_cert_primaria')->nullable();
            $table->tinyInteger('boletas_anteriores');
            $table->string('obs_boletas_anteriores')->nullable();
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
        Schema::dropIfExists('expediente_alumnos');
    }
}
