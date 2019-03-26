<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_periodos', function (Blueprint $table) {
            $table->increments('id_periodo');
            $table->string('periodo');
            $table->smallInteger('trimestre_preescolar')->nullable()->default(0);
            $table->smallInteger('bimestre_primaria')->nullable()->default(0);
            $table->smallInteger('bimestre_secundaria')->nullable()->default(0);
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
        Schema::dropIfExists('cat_periodos');
    }
}
