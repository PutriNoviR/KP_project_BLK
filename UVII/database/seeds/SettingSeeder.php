<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('uvii')->table('settings')->insert([
            [
                'key' => 'durasi',
                'value' => '20:00',
            ],
            [
                'key' => 'jmlSoal',
                'value' => '1',
            ],
            [
                'key' => 'soal_perHalaman',
                'value' => '1',
            ]
        ]);
    }
}
