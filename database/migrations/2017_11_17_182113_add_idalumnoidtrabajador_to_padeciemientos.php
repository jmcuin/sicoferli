<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdalumnoidtrabajadorToPadeciemientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('padecimientos', function (Blueprint $table) {
            //
            $table->integer('id_alumno')->after('id_padecimiento')->nullable()->unsigned();
            $table->foreign('id_alumno')
                  ->references('id_alumno')
                  ->on('alumnos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('id_trabajador')->after('id_padecimiento')->nullable()->unsigned();
            $table->foreign('id_trabajador')
                  ->references('id_trabajador')
                  ->on('trabajadors')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('padecimientos', function (Blueprint $table) {
            //
            $table -> dropColumn('id_alumno');
            $table -> dropColumn('id_trabajador');
        });
    }
}
