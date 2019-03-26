<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropEnviadoElPlaneaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planeaciones', function (Blueprint $table) {
            //
            $table -> dropColumn('enviado_el');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planeaciones', function (Blueprint $table) {
            //
            $table->date('enviado_el')->nullable()->after('enviar');
        });
    }
}
