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
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ListPesertaPdfExport implements WithEvents, FromCollection, WithHeadings
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
        //$totalPeserta = DB::connection('uvii')->table('uji_minat_awals')->distinct('users_email')->count('users_email');

        $user = User::hasilTerakhir($data);

        foreach($user as $key=>$d){
            $datas=[
                'no'=>$no,
                'nama'=>$d['nama_depan']." ".$d['nama_belakang'],
                'informasi tambahan'=>"Email: ".$d['email']."\nDomisili:".$d['kota']."\nPendidikan: ".$d['pendidikan']."\n(".$d['konsentrasi'].")",
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
            'Informasi Tambahan',
            'Hasil Klaster',
            'Hasil Kategori',
        ];
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function(AfterSheet $event) {
              
                $event->sheet->getDelegate()->getStyle('A1:E1')
                                ->getFont()
                                ->setBold(true)
                                ->setSize(12);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(2);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(15);
            },
        ];
    }
}