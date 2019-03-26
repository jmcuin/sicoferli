<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave_preescolar');
            $table->string('zona_escolar');
            $table->string('rfc_colegio');
            $table->string('razon_social');
            $table->string('domicilio');
            $table->string('telefono_contacto');
            $table->string('correo_electronico');
            $table->integer('id_periodo')->nullable()->unsigned();
            $table->foreign('id_periodo')
                  ->references('id_periodo')
                  ->on('cat_periodos')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
            $table->string('direccion_general');
            $table->string('direccion_preescolar');
            $table->string('direccion_primaria');
            $table->string('direccion_secundaria');
            $table->string('direccion_ingles');
            $table->float('costo_colegiatura');
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
        Schema::dropIfExists('settings');
    }
}
