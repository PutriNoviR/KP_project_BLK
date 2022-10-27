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

class ListPesertaPdfExport implements FromView, WithEvents
// FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     $datas=[];
    //     $seluruh_data=[];
    //     $idRole = Role::where('nama_role', 'peserta')->first();
    //     $data = User::where('roles_id', $idRole->id)->get();
    //     $no = 1;
    //     $totalPeserta = DB::connection('uvii')->table('uji_minat_awals')->distinct('users_email')->count('users_email');

    //     $user = User::hasilTerakhir($data);

    //     foreach($user as $key=>$d){
    //         $datas=[
    //             'id'=>$no,
    //             'nama'=>$d['nama_depan']." ".$d['nama_belakang'],
    //             'email'=>$d['email'],
    //             'tempat tanggal lahir'=>$d['tempat_lahir'].", ".date('d-m-Y', strtotime($d['tanggal_lahir'])),
    //             'kota domisili'=>$d['kota'],
    //             'alamat'=>$d['alamat'],
    //             // 'username'=>$d['username'],
    //             // 'pendidikan'=>$d['pendidikan']." - ".$d['konsentrasi'],
    //             'klaster'=>$d['klaster'],
    //             'kategori'=>$d['kategori'],
    //         ];
    //         array_push($seluruh_data,$datas);
    //         $no++;

    //     }
         
       
    //     return collect($seluruh_data);//collect(['user','riwayat_tes','dataKlaster','dataKategori']);
    // }
    // public function headings(): array{
    //     return [
    //         'No',
    //         'Nama Lengkap',
    //         'Email',
    //         'Tempat Tanggal Lahir',
    //         'Kota',
    //         'Alamat',
    //         // 'Username',
    //         'Hasil Klaster',
    //         'Hasil Kategori',
    //     ];
    // }
    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->mergeCells('A1:H1');
                $event->sheet->mergeCells('A2:H2');
                $event->sheet->mergeCells('A3:H3');
                $event->sheet->mergeCells('A4:H4');
                $event->sheet->mergeCells('A5:H5');

                for($i=6; $i<($event->sheet->getHighestRow() + 1); $i++){
                    $event->sheet->mergeCells("G".$i.":H".$i); 
                }

                $event->sheet->getDelegate()->getStyle('A6:H6')
                                ->getFont()
                                ->setBold(true)
                                ->setSize(10);
                 $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                // $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(32);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(5);
                // $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(18);
                // $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(18);
                // $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(5);
                // $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(14);
                // $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(30);
            },
        ];
    }

    public function view(): View
    {
        $idRole = Role::where('nama_role', 'peserta')->first();
        $data = User::where('roles_id',$idRole->id)->get();
        $totalPeserta = DB::connection('uvii')->table('uji_minat_awals')->distinct('users_email')->count('users_email');

        $user = User::hasilTerakhir($data);

        return view('export.daftarPesertaPdf', compact('user','totalPeserta'));
    }
}