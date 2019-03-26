<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPeriodoYEscolaridadToGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_grupos', function (Blueprint $table) {
            //
            $table->integer('id_periodo')->before('id_grupo')->nullable()->unsigned();
            $table->foreign('id_periodo')
                  ->references('id_periodo')
                  ->on('cat_periodos')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
            $table->integer('id_escolaridad')->after('id_periodo')->nullable()->unsigned();
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
        Schema::table('cat_grupos', function (Blueprint $table) {
            //
            $table->dropColumn('id_periodo');
            $table->dropColumn('id_escolaridad');
        });
    }
}
