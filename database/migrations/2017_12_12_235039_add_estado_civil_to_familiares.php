<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstadoCivilToFamiliares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('familiar_trabajadors', function (Blueprint $table) {
            //
            $table->integer('id_estado_civil')->nullable()->after('fecha_nacimiento')->unsigned();
            $table->foreign('id_estado_civil')
                  ->references('id_estado_civil')
                  ->on('cat_estado_civils')
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
        Schema::table('familiar_trabajadors', function (Blueprint $table) {
            //
            $table -> dropColumn('id_estado_civil');
        });
    }
}
