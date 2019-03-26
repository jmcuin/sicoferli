<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAutorAgenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agenda', function (Blueprint $table) {
            //
            $table->integer('id_trabajador')->unsigned()->nullable()->after('hora_fin');
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
        Schema::table('agenda', function (Blueprint $table) {
            //
            $table->dropColumn('id_trabajador');
        });
    }
}
