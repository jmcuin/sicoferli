<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelacionReferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('padecimientos', function (Blueprint $table) {
            //
            $table->string('ref1_relacion')->after('ref1_tel')->nullable();
            $table->string('ref2_relacion')->after('ref2_tel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('padecimientos', function (Blueprint $table) {
            //
            $table -> dropColumn('ref1_relacion');
            $table -> dropColumn('ref2_relacion');
        });
    }
}
