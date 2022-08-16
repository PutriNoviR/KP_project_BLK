<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class KejuruanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kejuruans')->insert([
            [
                'nama' => 'Bisnis dan Manajemen',
             
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
                
             ],
             [
                'nama' => 'Perikanan',
              
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
             ],
             [
                'nama' => 'Processing',
               
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
             ],
             [
                'nama' => 'Industri Kreatif',
              
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
             ],
             [
                'nama' => 'Garment',
               
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
             ],
             [
                'nama' => 'Designer Grafis',
                
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
             ],
             [
                'nama' => 'Tata Kecantikan',
                
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
             ],
     ]);
  
      
    }
} 