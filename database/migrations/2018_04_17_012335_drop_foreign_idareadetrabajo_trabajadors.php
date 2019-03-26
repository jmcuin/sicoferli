<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForeignIdareadetrabajoTrabajadors extends Migration
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
            $table->dropForeign('trabajadors_id_area_de_trabajo_foreign');
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
            $table->integer('id_area_de_trabajo')
                  ->after('tipo_sangre')
                  ->unsigned();
            $table->foreign('id_area_de_trabajo')
                  ->references('id_area_de_trabajo')
                  ->on('cat_areasdetrabajos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }
}
