<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SubKejuruanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_kejuruans')->insert([
            [
                'nama' => 'Bahasa Inggris / JAA',
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'kejuruans_id'=> 1,
                'kode_kategori'=> 1,
                'kode_klaster'=> 1,
             ],
             [
                'nama' => 'Program Bahasa',
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'kejuruans_id'=> 1,
                'kode_kategori'=>1,
                'kode_klaster'=> 1, 
             ],
             [
                'nama' => 'Teknisi Akuntansi Junior',
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'kejuruans_id'=> 1,
                'kode_kategori'=>2,
                'kode_klaster'=> 1,
             ],
             ['nama' => 'Pelayanan Pelanggan',
             'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
             'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
             'kejuruans_id'=> 1,
             'kode_kategori'=>3,
             'kode_klaster'=> 1,
             ],
             [
                'nama' => 'TIK Desain grafis Madya',
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'kejuruans_id'=> 6,
                'kode_kategori'=>9,
                'kode_klaster'=> 3,
             ],
             [
                'nama' => 'Budidaya',
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'kejuruans_id'=> 2,
                'kode_kategori'=>4,
                'kode_klaster'=> 2,
             ],
             [
                'nama' => 'Pengolahan Ikan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'kejuruans_id'=> 3,
                'kode_kategori'=>5,
                'kode_klaster'=> 2,
             ],
             [
                'nama' => ' Hidroponik',
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'kejuruans_id'=> 3,
                'kode_kategori'=>6,
                'kode_klaster'=> 2,
             ],
             [
                'nama' => 'Pembuatan Hiasan Busana Dengan Mesin Bordir Manual',
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'kejuruans_id'=> 4,
                'kode_kategori'=>7,
                'kode_klaster'=> 3,
             ],
             [
                'nama' => 'Asisten Junior Pattern Maker',
                'created_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:m'),
                'kejuruans_id'=> 5,
                'kode_kategori'=>8,
                'kode_klaster'=> 3,
             ],

     ]);
  
    }
}