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
            [ 'nama' => 'Administrasi dan Layanan',
                'link_kejuruan_tes_2'=>'https://www.kompas.com/skola/read/2021/08/18/154901669/administrasi-pengertian-tujuan-ciri-ciri-fungsi-dan-jenisnya',
            ],
            ['nama'=>'Agriculture',
            'link_kejuruan_tes_2'=>'https://hot.liputan6.com/read/4693295/agrikultur-adalah-upaya-membuat-pangan-di-bidang-pertanian-ketahui-jenis-jenisnya',],
            ['nama'=>'Seni',
            'link_kejuruan_tes_2'=>'',
            ],
            ['nama'=>'Teknik','link_kejuruan_tes_2'=>'https://www.kompas.com/edu/read/2021/11/10/131100771/17-jurusan-teknik-dengan-prospek-kerja-menjanjikan-kamu-pilih-mana?page=all',],
            
            
        ]);
    }
}
