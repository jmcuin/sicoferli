<?php

use Illuminate\Database\Seeder;
use App\CriterioDesempenio;

class CriteriosDesempenioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		CriterioDesempenio::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        CriterioDesempenio::create([
        	'criterio' => 'Excelencia',
        	'descripcion' => 'Alumnos destacados en todos los campos.',
        	'porcentaje_examen' => 60,
        	'porcentaje_tareas' => 15,
        	'porcentaje_tomas_clase' => 15,
        	'porcentaje_participacion' => 10
        ]);
        CriterioDesempenio::create([
        	'criterio' => 'Creativo+',
        	'descripcion' => 'Alumnos predominantemente destacados en los campos artísticos.',
        	'porcentaje_examen' => 60,
        	'porcentaje_tareas' => 20,
        	'porcentaje_tomas_clase' => 10,
        	'porcentaje_participacion' => 10
        ]);
        CriterioDesempenio::create([
        	'criterio' => 'Creativo',
        	'descripcion' => 'Alumnos destacados en los campos artísticos.',
        	'porcentaje_examen' => 40,
        	'porcentaje_tareas' => 25,
        	'porcentaje_tomas_clase' => 25,
        	'porcentaje_participacion' => 10
        ]);
        CriterioDesempenio::create([
        	'criterio' => 'Ciencias+',
        	'descripcion' => 'Alumnos predominantemente destacados en los campos de las ciencias exactas.',
        	'porcentaje_examen' => 60,
        	'porcentaje_tareas' => 20,
        	'porcentaje_tomas_clase' => 10,
        	'porcentaje_participacion' => 10
        ]);
        CriterioDesempenio::create([
            'criterio' => 'Ciencias',
            'descripcion' => 'Alumnos predominantemente destacados en los campos de las ciencias exactas.',
            'porcentaje_examen' => 40,
            'porcentaje_tareas' => 25,
            'porcentaje_tomas_clase' => 25,
            'porcentaje_participacion' => 10
        ]);
    }
}
