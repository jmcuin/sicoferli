<?php

use App\User;
use App\Trabajador;
use App\Padecimiento;
use App\AntecedenteLaboral;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		//User::truncate();
		//DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $trabajador = Trabajador::create([
            'nombre' => 'coferli',
            'a_paterno' => 'coferli',
            'curp' => 'XXXX010101MXXXXXXX',
            'rfc' => 'XXXX010101',
            'seguro_social' => '11111',
            'id_estado_civil' => '1',
            'id_estado_municipio' => '834',
            'telefono' => '111111',
            'email' => 'direccion@lizardi.edu.mx',
            'id_prep_academica' => '9',
            'id_religion' => '9',
            'id_escolaridad' => '1'
        ]);

        $user = User::create([
            'id_trabajador' => $trabajador -> id_trabajador,
        	'matricula' => 'coferli',
        	'email' => 'direccion@lizardi.edu.mx',
        	'password' => bcrypt('coferli')
        ]);

        DB::table('roles_x_users')->insert([
            'id_user' => $user -> id_user,
            'id_rol' => '1'
        ]);

        $padecimiento = Padecimiento::create([
            'id_trabajador' => '1'
        ]);

        $antecedente_laboral = AntecedenteLaboral::create([
            'id_trabajador' => '1'
        ]);
    }
}
