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
            $table->boolean('acta_nacimiento');
            $table->string('obs_acta')->nullable();
            $table->boolean('curp');
            $table->string('obs_curp')->nullable();
            $table->boolean('cartilla_vacunacion');
            $table->string('obs_cartilla')->nullable();
            $table->boolean('certificado_medico');
            $table->string('obs_cert_medico')->nullable();
            $table->boolean('constancia_estudios');
            $table->string('obs_constancia')->nullable();
            $table->boolean('curp_padre');
            $table->string('obs_curp_padre')->nullable();
            $table->boolean('curp_madre');
            $table->string('obs_curp_madre')->nullable();
            $table->boolean('ife_padre');
            $table->string('obs_ife_padre')->nullable();
            $table->boolean('ife_madre');
            $table->string('obs_ife_madre')->nullable();
            $table->boolean('comp_domicilio');
            $table->string('obs_comp_domicilio')->nullable();
            $table->boolean('boleta_anterior');
            $table->string('obs_boleta_anterior')->nullable();
            $table->boolean('carta_conducta');
            $table->string('obs_carta_conducta')->nullable();
            $table->boolean('cert_primaria');
            $table->string('obs_cert_primaria')->nullable();
            $table->boolean('boletas_anteriores');
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
