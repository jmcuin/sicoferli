<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAreaDeInformes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('informes', function (Blueprint $table) {
            //
            $table->integer('id_escolaridad')->unsigned() -> nullable() -> after('mensaje');
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
        Schema::table('informes', function (Blueprint $table) {
            //
            $table -> dropForeign('informes_id_escolaridad_foreign');
            $table -> dropColumn('id_escolaridad');
        });
    }
}
