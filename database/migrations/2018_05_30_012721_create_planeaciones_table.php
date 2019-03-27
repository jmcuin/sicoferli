<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaneacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planeaciones', function (Blueprint $table) {
            $table->increments('id_planeacion');
            $table->integer('id_trabajador')->nullable()->unsigned();
            $table->foreign('id_trabajador')
                  ->references('id_trabajador')
                  ->on('trabajadors')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
            $table->string('comentarios')->nullable();
            $table->tinyInteger('enviar')->nullable();
            $table->dateTime('enviado_el')->nullable();
            $table->date('semana'); 
            $table->string('semaforo')->nullable();
            $table->tinyInteger('nuevo')->nullable()->default('1');
            $table->string('archivo');
            $table->tinyInteger('anual')->nullable();
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
        Schema::dropIfExists('planeaciones');
    }
}
