<?php

use App\Parentesco;
use Illuminate\Database\Seeder;

class ParentescoTableSeeder extends Seeder
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
		Parentesco::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Parentesco::create([
        	'parentesco' => 'Padre'
        ]);
        Parentesco::create([
        	'parentesco' => 'Madre'
        ]);
        Parentesco::create([
        	'parentesco' => 'Hermano(a)'
        ]);
        Parentesco::create([
        	'parentesco' => 'Hijo(a)'
        ]);
        Parentesco::create([
        	'parentesco' => 'Esposo(a)'
        ]);
        Parentesco::create([
        	'parentesco' => 'Abuelo(a)'
        ]);
        Parentesco::create([
        	'parentesco' => 'Tío(a)'
        ]);
        Parentesco::create([
        	'parentesco' => 'Primo'
        ]);
    }
}
