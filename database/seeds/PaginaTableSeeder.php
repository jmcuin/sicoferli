<?php

use App\Pagina;
use Illuminate\Database\Seeder;

class PaginaTableSeeder extends Seeder
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
		Pagina::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');*/
        Pagina::create([
        	'descripcion' => 'Configuarción inicial.',
        	'banner_principal_texto' => 'Colegio Fernández de Lizardi',
        	'instalaciones_titulo' => 'Título para instalaciones',
        	'instalaciones_texto' => 'Descripción para instalaciones',
        	'horario_titulo' => 'Título para horarios',
        	'horario_texto' => 'Texto para horarios',
        	'taller_encabezado' => 'Encabezado para talleres',
        	'activo' => '1',
        	'desde' => new DateTime()
        ]);
        
    }
}
