<?php

use App\Rol;
use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
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
		Rol::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');*/
        Rol::create([
        	'rol_key' => 'administracion_sitio',
        	'rol' => 'Administrador(a)',
        	'descripcion' => 'Administrador del sitio.'
        ]);
        Rol::create([
        	'rol_key' => 'direccion_general',
        	'rol' => 'Director(a) General',
        	'descripcion' => 'Director general de la Institución.'
        ]);
        Rol::create([
        	'rol_key' => 'direccion_nivel',
        	'rol' => 'Director(a) de nivel',
        	'descripcion' => 'Director de nivel o área académica.'
        ]);
        Rol::create([
        	'rol_key' => 'profesor',
        	'rol' => 'Profesor(a)',
        	'descripcion' => 'Profesor(a) de grupo o asignatura.'
        ]);
        Rol::create([
        	'rol_key' => 'administracion',
        	'rol' => 'Administrador(a) de activos',
        	'descripcion' => 'Responsable administrativo(a) de la Institución.'
        ]);
        Rol::create([
        	'rol_key' => 'asistencia_administrativa',
        	'rol' => 'Asistente administrativo(a)',
        	'descripcion' => 'Asistente administrativo(a) de la Institución.'
        ]);
        Rol::create([
            'rol_key' => 'alumno',
            'rol' => 'Alumno(a)',
            'descripcion' => 'Alumno(a) de la Institución.'
        ]);
    }
}
