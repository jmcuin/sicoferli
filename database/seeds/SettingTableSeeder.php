<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
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
		Setting::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
		Setting::create([
        	'clave_preescolar' => 'Por definir',
        	'clave_primaria' => 'Por definir',
        	'clave_secundaria' => 'Por definir',
        	'zona_escolar' => 'Por definir',
        	'rfc_colegio' => 'XXXXXXXXXXXXX',
        	'razon_social' => 'Por definir',
        	'domicilio' => 'Por definir',
        	'telefono_contacto' => 'Por definir',
        	'correo_electronico' => 'Por definir',
        	'direccion_general' => 'Por definir',
        	'direccion_preescolar' => 'Por definir',
        	'direccion_primaria' => 'Por definir',
        	'direccion_secundaria' => 'Por definir',
        	'direccion_ingles' => 'Por definir',
        	'costo_colegiatura' => 0.0
        ]);
    }
}
