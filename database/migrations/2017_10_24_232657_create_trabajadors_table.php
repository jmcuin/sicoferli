<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->increments('id_trabajador');
            $table->string('nombre');
            $table->string('a_paterno');
            $table->string('a_materno')->nullable();
            $table->string('curp')->unique();
            $table->string('rfc')->unique();
            $table->string('seguro_social')->unique();
            $table->integer('id_estado_civil')->unsigned();
            $table->foreign('id_estado_civil')
                  ->references('id_estado_civil')
                  ->on('cat_estado_civils')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_estado_municipio')->unsigned();      
            $table->foreign('id_estado_municipio')
                  ->references('id_estado_municipio')
                  ->on('cat_municipios')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('extranjero')->nullable();      
            $table->string('calle')->nullable();
            $table->string('numero_interior')->nullable();
            $table->string('numero_exterior')->nullable();
            $table->string('colonia')->nullable();
            $table->mediumInteger('cp')->nullable();
            $table->string('telefono')->nullable();
            $table->integer('id_religion')->unsigned();
            $table->foreign('id_religion')
                  ->references('id_religion')
                  ->on('cat_religions')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('tipo_sangre')->nullable();
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
        Schema::dropIfExists('trabajadors');
    }
}
