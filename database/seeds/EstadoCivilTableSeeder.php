<?php

use App\EstadoCivil;
use Illuminate\Database\Seeder;

class EstadoCivilTableSeeder extends Seeder
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
		EstadoCivil::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');*/
        EstadoCivil::create([
        	'estado_civil' => 'Soltero(a)'
        ]);
        EstadoCivil::create([
        	'estado_civil' => 'Casado(a)'
        ]);
        EstadoCivil::create([
        	'estado_civil' => 'Viudo(a)'
        ]);
        EstadoCivil::create([
        	'estado_civil' => 'Divorciado(a)'
        ]);
    }
}
