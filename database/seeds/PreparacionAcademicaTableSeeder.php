<?php

use App\PrepAcademica;
use Illuminate\Database\Seeder;

class PreparacionAcademicaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		PrepAcademica::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');*/
        PrepAcademica::create([
        	'grado_academico' => 'Ninguno'
        ]);
        PrepAcademica::create([
        	'grado_academico' => 'Primaria trunca'
        ]);
        PrepAcademica::create([
        	'grado_academico' => 'Primaria'
        ]);
        PrepAcademica::create([
        	'grado_academico' => 'Secundaria trunca'
        ]);
        PrepAcademica::create([
        	'grado_academico' => 'Secundaria'
        ]);
        PrepAcademica::create([
        	'grado_academico' => 'Preparatoria trunca'
        ]);
        PrepAcademica::create([
        	'grado_academico' => 'Preparatoria'
        ]);
        PrepAcademica::create([
        	'grado_academico' => 'Licenciatura trunca'
        ]);
        PrepAcademica::create([
        	'grado_academico' => 'Licenciatura'
        ]);
        PrepAcademica::create([
        	'grado_academico' => 'Maestria trunca'
        ]);
        PrepAcademica::create([
        	'grado_academico' => 'Maestria'
        ]);
        PrepAcademica::create([
        	'grado_academico' => 'Doctorado trunco'
        ]);
        PrepAcademica::create([
        	'grado_academico' => 'Doctorado'
        ]);
        PrepAcademica::create([
        	'grado_academico' => 'Posdoctorado'
        ]);
    }
}
