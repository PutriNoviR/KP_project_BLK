<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
                'nama_role' => 'Peserta',
                'deskripsi' => 'Peserta dapat mendaftar pelatihan dan mengikuti tes minat bakat',
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m')
            ]);
    }
}
