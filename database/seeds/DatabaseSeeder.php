<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(EscolaridadTableSeeder::class);
        $this->call(EstadoCivilTableSeeder::class);
        $this->call(EstadoTableSeeder::class);
    	$this->call(MunicipioTableSeeder::class);
        $this->call(ParentescoTableSeeder::class);
    	$this->call(PreparacionAcademicaTableSeeder::class);
    	$this->call(ReligionTableSeeder::class);
    	$this->call(UserTableSeeder::class);
    	$this->call(PaginaTableSeeder::class);
    }
}
