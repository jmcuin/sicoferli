<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPrepAcademica extends Migration
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
            $table->integer('id_prep_academica')->nullable()->unsigned()->after('id_escolaridad');
            $table->foreign('id_prep_academica')
                  ->references('id_prep_academica')
                  ->on('cat_prep_academicas')
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
        Schema::table('trabajadors', function (Blueprint $table) {
            //
            $table -> dropForeign('id_prep_academica');
            $table -> dropColumn('id_prep_academica');
        });
    }
}
