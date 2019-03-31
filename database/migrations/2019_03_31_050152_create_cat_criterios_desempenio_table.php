<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatCriteriosDesempenioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_criterios_desempenio', function (Blueprint $table) {
            $table->increments('id_criterio_desempenio');
            $table->string('criterio');
            $table->string('descripcion')->nullable();
            $table->smallInteger('porcentaje_examen')->nullable()->default(0);
            $table->smallInteger('porcentaje_tareas')->nullable()->default(0);
            $table->smallInteger('porcentaje_tomas_clase')->nullable()->default(0);
            $table->smallInteger('porcentaje_participacion')->nullable()->default(0);
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
        Schema::dropIfExists('cat_criterios_desempenio');
    }
}
