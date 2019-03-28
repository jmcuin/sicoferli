<?php

use App\Estado;
use Illuminate\Database\Seeder;

class EstadoTableSeeder extends Seeder
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
		Estado::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Estado::create([
        	'estado' => 'Aguascalientes'
        ]);
        Estado::create([
        	'estado' => 'Baja California'
        ]);
        Estado::create([
        	'estado' => 'Baja California Sur'
        ]);
        Estado::create([
        	'estado' => 'Campeche'
        ]);
        Estado::create([
        	'estado' => 'Coahuila'
        ]);
        Estado::create([
        	'estado' => 'Colima'
        ]);
        Estado::create([
        	'estado' => 'Chiapas'
        ]);
        Estado::create([
        	'estado' => 'Chihuahua'
        ]);
        Estado::create([
        	'estado' => 'Ciudad de México'
        ]);
        Estado::create([
        	'estado' => 'Durango'
        ]);
        Estado::create([
        	'estado' => 'Guanajuato'
        ]);
        Estado::create([
        	'estado' => 'Guerrero'
        ]);
        Estado::create([
        	'estado' => 'Hidalgo'
        ]);
        Estado::create([
        	'estado' => 'Jalisco'
        ]);
        Estado::create([
        	'estado' => 'México'
        ]);
        Estado::create([
        	'estado' => 'Michoacán'
        ]);
        Estado::create([
        	'estado' => 'Morelos'
        ]);
        Estado::create([
        	'estado' => 'Nayarit'
        ]);
        Estado::create([
        	'estado' => 'Nuevo León'
        ]);
        Estado::create([
        	'estado' => 'Oaxaca'
        ]);
        Estado::create([
        	'estado' => 'Puebla'
        ]);
        Estado::create([
        	'estado' => 'Querétaro'
        ]);
        Estado::create([
        	'estado' => 'Quintana Roo'
        ]);
        Estado::create([
        	'estado' => 'San Luis Potosí'
        ]);
        Estado::create([
        	'estado' => 'Sinaloa'
        ]);
        Estado::create([
        	'estado' => 'Sonora'
        ]);
        Estado::create([
        	'estado' => 'Tabasco'
        ]);
        Estado::create([
        	'estado' => 'Tamaulipas'
        ]);
        Estado::create([
        	'estado' => 'Tlaxcala'
        ]);
        Estado::create([
        	'estado' => 'Veracruz'
        ]);
        Estado::create([
        	'estado' => 'Yucatán'
        ]);
        Estado::create([
        	'estado' => 'Zacatecas'
        ]);
    }
}
