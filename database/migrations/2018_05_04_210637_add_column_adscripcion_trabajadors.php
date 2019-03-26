<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAdscripcionTrabajadors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trabajadors', function (Blueprint $table) {
            //
            $table->integer('id_escolaridad')->unsigned() -> nullable() -> after('tipo_sangre');
            $table->foreign('id_escolaridad')
                  ->references('id_escolaridad')
                  ->on('cat_escolaridads')
                  ->onDelete('set null')
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
        Schema::table('trabajadors', function (Blueprint $table) {
            //
            $table -> dropForeign('id_escolaridad');
            $table -> dropColumn('id_escolaridad');
        });
    }
}
