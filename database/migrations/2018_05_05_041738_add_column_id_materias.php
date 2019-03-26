<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnIdMaterias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notificaciones', function (Blueprint $table) {
            //
            $table->integer('id_materia')->nullable()->unsigned()->after('id_grupo');
            $table->foreign('id_materia')
                  ->references('id_materia')
                  ->on('cat_materias')
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
        Schema::table('notificaciones', function (Blueprint $table) {
            //
            $table -> dropForeign('id_materia');
            $table -> dropColumn('id_materia');
        });
    }
}
