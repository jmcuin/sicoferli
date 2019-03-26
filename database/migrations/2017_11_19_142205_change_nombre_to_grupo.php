<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNombreToGrupo extends Migration
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
            $table->dropColumn('nombre');
            $table->string('grupo')->after('id_grupo');
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
            $table->dropColumn('grupo');
        });
    }
}
