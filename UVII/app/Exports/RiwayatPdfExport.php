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
use App\UjiMinatAwal;
use App\KlasterPsikometrik;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RiwayatPdfExport implements WithEvents,WithHeadings, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $datas=[];
        $seluruh_data=[];

        $idRole = Role::where('nama_role', 'peserta')->first();
        $dataUser = User::where('roles_id', $idRole->id)->get();
        $user = User::hasilTerakhir($dataUser);

        $riwayat_tes = UjiMinatAwal::where(DB::raw("(DATE_FORMAT(tanggal_mulai,'%Y-%m-%d'))"),'>=','2022-11-02')->get();

        $no =1;
    
        foreach($riwayat_tes as $riwayat){
            foreach($user as $d){
                if($riwayat->users_email == $d['email']){
                    $datas=[
                        'kode'=>$no,
                        'nama'=>$d['nama_depan']." ".$d['nama_belakang'],
                        'email'=>$d['email'],
                        'mulai tes'=>"Mulai: ".$riwayat->tanggal_mulai."\n\nSelesai: ".$riwayat->tanggal_selesai,
                        'klaster'=>$d['klaster'],
                        'kategori'=>$d['kategori'],
                    ];
                    array_push($seluruh_data,$datas);

                    $no++;
                }
    
            }
        }
     
        return collect($seluruh_data);//collect(['user','riwayat_tes','dataKlaster','dataKategori']);
    }
    
    public function headings(): array{
        return [
           
            [
                'No',
                'Nama Lengkap',
                'Email',
                'Tanggal Tes',
                'Hasil Klaster',
                'Hasil Kategori',
            ]
        ];
    }

    public function registerEvents(): array
    {
      
        return [
          
                AfterSheet::class => function(AfterSheet $event) {

                    $event->sheet->getDelegate()->getStyle('A1:F1')
                            ->getFont()
                            ->setBold(true)
                            ->setSize(12);
        
                    $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                    $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(10);
                    $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(10);
                    $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(15);
                },
            
        ];
    }

    // public function view(): View
    // {
    //     $idRole = Role::where('nama_role', 'peserta')->first();
    //     $user = DB::connection('mysql')->table('users')->where('roles_id',$idRole->id)->get();
       
    //     $riwayat_tes= UjiMinatAwal::where(DB::raw("(DATE_FORMAT(tanggal_mulai,'%Y-%m-%d'))"),'>=','2022-11-02')->get();
    //     $dataKlaster = KlasterPsikometrik::all();
    //     $dataKategori = UjiMinatAwal::getDataKategoriPsikometrik($riwayat_tes);

    //     $data = User::hasilTesSemuaPeserta($user, $riwayat_tes, $dataKlaster, $dataKategori);

    //     $totalPeserta = DB::connection('uvii')->table('uji_minat_awals')->distinct('users_email')->count('users_email');

    //     return view('export.riwayatPdf', compact('data','totalPeserta'));
    // }
}