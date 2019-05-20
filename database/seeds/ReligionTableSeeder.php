<?php

use App\Religion;
use Illuminate\Database\Seeder;

class ReligionTableSeeder extends Seeder
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
		Religion::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');*/
        Religion::create([
        	'religion' => 'Ateismo'
        ]);
        Religion::create([
        	'religion' => 'Católica'
        ]);
        Religion::create([
        	'religion' => 'Cristiana'
        ]);
        Religion::create([
        	'religion' => 'Evangélica'
        ]);
        Religion::create([
        	'religion' => 'Pentecostal'
        ]);
        Religion::create([
        	'religion' => 'Protestante'
        ]);
        Religion::create([
        	'religion' => 'Judaica'
        ]);
        Religion::create([
        	'religion' => 'Islámica'
        ]);
        Religion::create([
        	'religion' => 'Ninguna'
        ]);
        Religion::create([
        	'religion' => 'Otra'
        ]);
    }
}
