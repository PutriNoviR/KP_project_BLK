<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create();
        // for($i=0; $i<50; $i++){
            DB::table('countries')->insert([
                'nama' => 'Indonesia',
                'deskripsi' => '',
        
            ]);
        // }

        
    }
}
