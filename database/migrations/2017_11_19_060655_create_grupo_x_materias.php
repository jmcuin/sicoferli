<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoXMaterias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('materia_x_grupos', function (Blueprint $table) {
            $table->integer('id_grupo')->nullable()->unsigned();
            $table->foreign('id_grupo')
                  ->references('id_grupo')
                  ->on('cat_grupos')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
            $table->integer('id_materia')->nullable()->unsigned();
            $table->foreign('id_materia')
                  ->references('id_materia')
                  ->on('cat_materias')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
            $table->integer('id_trabajador')->nullable()->unsigned();
            $table->foreign('id_trabajador')
                  ->references('id_trabajador')
                  ->on('trabajadors')
                  ->onDelete('set null')
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
        //
        Schema::dropIfExists('materia_x_grupos');
    }
}
