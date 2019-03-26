<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConyugeXTrabajadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conyuge_x_trabajadors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_trabajador')->nullable()->unsigned();
            $table->foreign('id_trabajador')
                  ->references('id_trabajador')
                  ->on('trabajadors')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_conyuge')->unsigned();
            $table->boolean('es_trabajador');
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
        Schema::dropIfExists('conyuge_x_trabajadors');
    }
}
