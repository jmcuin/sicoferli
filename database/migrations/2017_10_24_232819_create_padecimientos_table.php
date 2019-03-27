<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePadecimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('padecimientos', function (Blueprint $table) {
            $table->increments('id_padecimiento');
            $table->string('alergia')->nullable();
            $table->string('enfermedad')->nullable();
            $table->string('medicina')->nullable();
            $table->string('medico')->nullable();
            $table->string('tel_medico')->nullable();
            $table->string('ref1_nombre')->nullable();
            $table->string('ref1_tel')->nullable();
            $table->string('ref2_nombre')->nullable();
            $table->string('ref2_tel')->nullable();
            $table->string('cirugia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('padecimientos');
    }
}
