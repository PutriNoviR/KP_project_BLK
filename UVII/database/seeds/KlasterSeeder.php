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
            'link_kejuruan_tes_2'=>'http://103.166.156.245/uvii2/mod/quiz/view.php?id=16',
            ],
            ['nama'=>'Agriculture',
            'link_kejuruan_tes_2'=>'http://103.166.156.245/uvii2/mod/quiz/view.php?id=18',],
            ['nama'=>'Seni',
            'link_kejuruan_tes_2'=>'http://103.166.156.245/uvii2/mod/quiz/view.php?id=19',
            ],
            ['nama'=>'Teknik',
            'link_kejuruan_tes_2'=>'http://103.166.156.245/uvii2/mod/quiz/view.php?id=20',],
                     
        ]);
    }
}
