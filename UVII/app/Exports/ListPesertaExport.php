<?php

namespace App\Exports;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\User;
use App\Role;

class ListPesertaExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $datas=[];
        $seluruh_data=[];
        $idRole = Role::where('nama_role', 'peserta')->first();
        $data = User::where('roles_id', $idRole->id)->get();
        $no = 1;

        //menggabungkan hasil klaster dan kategori dengan user
        $hasil = User::hasilTerakhir($data);

        foreach($hasil as $key=>$d){
            $datas=[
                'id'=>$no,
                'nama'=>$d['nama_depan']." ".$d['nama_belakang'],
                'email'=>$d['email'],
                'jenis kelamin'=>$d['jenis_kelamin'],
                'nomor handphone'=>$d['No.Hp'],
                'tempat lahir'=>$d['tempat_lahir'],
                'tanggal lahir'=>$d['tanggal_lahir'],
                'kota domisili'=>$d['kota'],
                'alamat'=>$d['alamat'],
                'username'=>$d['username'],
                'pendidikan'=>$d['pendidikan']??"tidak ada",
                'konsentrasi'=>$d['konsentrasi']??"tidak ada",
                'klaster'=>$d['klaster'],
                'kategori'=>$d['kategori'],
            ];
            array_push($seluruh_data,$datas);
            $no++;

        }
         
       
        return collect($seluruh_data);//collect(['user','riwayat_tes','dataKlaster','dataKategori']);
    }
    public function headings(): array{
        return [
            'No',
            'Nama Lengkap',
            'Email',
            'Jenis Kelamin',
            'Nomor Handphone',
            'Kota Lahir',
            'Tanggal Lahir',
            'Kota Domisili',
            'Alamat',
            'Username',
            'Pendidikan',
            'Konsentrasi/Keahlian',
            'Hasil Klaster',
            'Hasil Kategori',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:L1')
                                ->getFont()
                                ->setBold(true);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(32);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(18);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(18);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(13);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(13);
                $event->sheet->getDelegate()->getColumnDimension('M')->setWidth(18);
   
            },
        ];
    }
}