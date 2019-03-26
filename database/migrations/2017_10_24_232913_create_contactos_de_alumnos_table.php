<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactosDeAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos_de_alumnos', function (Blueprint $table) {
            $table->increments('id_contactos_alumno');
            $table->string('nombre');
            $table->integer('id_parentesco')->unsigned();
            $table->foreign('id_parentesco')
                  ->references('id_parentesco')
                  ->on('cat_parentescos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->integer('id_trabajador')->nullable()->unsigned();
            $table->foreign('id_trabajador')
                  ->references('id_trabajador')
                  ->on('trabajadors')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_alumno')->nullable()->unsigned();      
            $table->foreign('id_alumno')
                  ->references('id_alumno')
                  ->on('alumnos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');      
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
        Schema::dropIfExists('contactos_de_alumnos');
    }
}
