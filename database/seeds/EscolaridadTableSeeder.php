<?php

use Illuminate\Database\Seeder;
use App\Escolaridad;

class EscolaridadTableSeeder extends Seeder
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
		Escolaridad::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');*/
        Escolaridad::create([
            'escolaridad' => 'Administracion',
            'nomenclatura_grupos' => 'Admin',
            'horario' => '7:30 a 15:00 hrs.'
        ]);
        Escolaridad::create([
        	'escolaridad' => 'Maternal',
        	'nomenclatura_grupos' => 'M',
        	'horario' => '8:00 a 12:00 hrs.'
        ]);
        Escolaridad::create([
        	'escolaridad' => 'Preescolar',
        	'nomenclatura_grupos' => 'K',
        	'horario' => '8:00 a 12:00 hrs.'
        ]);
    	Escolaridad::create([
        	'escolaridad' => 'Primaria',
        	'nomenclatura_grupos' => 'P',
        	'horario' => '8:00 a 14:00 hrs.'
        ]);
        Escolaridad::create([
        	'escolaridad' => 'Secundaria',
        	'nomenclatura_grupos' => 'S',
        	'horario' => '8:00 a 14:00 hrs.'
        ]);
    }
}
