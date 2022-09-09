<?php

use Illuminate\Database\Seeder;

class KlasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('klaster_psikometrik')->insert([
            ['nama' => 'Administrasi dan Layanan',
            'link_kejuruan_tes_2'=>'https://ubayavii.id/tahap2/mod/quiz/view.php?id=16',
            ],
            ['nama'=>'Agriculture',
            'link_kejuruan_tes_2'=>'https://ubayavii.id/tahap2/mod/quiz/view.php?id=24',],
            ['nama'=>'Seni',
            'link_kejuruan_tes_2'=>'https://ubayavii.id/tahap2/mod/quiz/view.php?id=25',
            ],
            ['nama'=>'Teknik',
            'link_kejuruan_tes_2'=>'https://ubayavii.id/tahap2/mod/quiz/view.php?id=26',],
                     
        ]);
    }
}
