<?php

use App\User;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		User::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $user = User::create([
        	'matricula' => 'coferli',
        	'name' => 'Administrador(a)',
        	'email' => 'direccion@lizardi.edu.mx',
        	'password' => bcrypt('coferli')
        ]);

        DB::table('roles_x_users')->insert([
            'id_user' => $user -> id_user,
            'id_rol' => '1'
        ]);
    }
}
