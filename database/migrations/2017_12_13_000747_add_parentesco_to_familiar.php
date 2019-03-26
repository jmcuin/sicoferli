<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentescoToFamiliar extends Migration
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
            $table->integer('id_parentesco')->nullable()->after('a_materno')->unsigned();
            $table->foreign('id_parentesco')
                  ->references('id_parentesco')
                  ->on('cat_parentescos')
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
            $table -> dropColumn('id_parentesco');
        });
    }
}
