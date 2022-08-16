<?php

use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('kategori_psikometrik')->insert([
               [
                   'kode' => 'Program Bahasa',
                   'nama' => 'Data-People'
                ],
                [
                    'kode' => 'Administrasi Perkantoran',
                   'nama' => 'Data-Things'   
                ],
                [
                    'kode' => '',
                   'nama' => 'Data-Things-People'
                ],
                [
                    'kode' => 'Pembudidaya Ternak',
                   'nama' => 'Things-Hewan',
                ],
                [
                    'kode' => 'Pengolah Hasil Pertanian',
                   'nama' => 'Things-Pengolahan',
                ],
                [
                    'kode' => 'Pengolah Hasil Pertanian',
                   'nama' => 'Things-Tanaman',
                ],
                [
                    'kode' => '',
                   'nama' => 'Idea-Things-Art',
                ],
                [
                    'kode' => '',
                   'nama' => 'Idea-Things-Garment',
                ],
                [
                    'kode' => 'Designer Grafis',
                   'nama' => 'Idea-Things-Media',
                ],
                [
                    'kode' => 'Penata Rias',
                   'nama' => 'Idea-Things-People'
                ],

        ]);
     
    }
}
