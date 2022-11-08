<?php


namespace App\Exports;
use App\UjiMinatAwal;
use App\KategoriPsikometrik;
use App\KlasterPsikometrik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\User;
use App\Role; 
use Carbon\Carbon;

class RiwayatExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $datas=[];
        $seluruh_data=[];
        $data_kategori=[];
        $idRole = Role::where('nama_role', 'peserta')->first();
        $user =User::where('roles_id',$idRole->id)->get();
        $riwayat_tes= UjiMinatAwal::where(DB::raw("(DATE_FORMAT(tanggal_mulai,'%Y-%m-%d'))"),'>=','2022-11-02')->get();
        $dataKlaster = KlasterPsikometrik::all();
        $dataKategori = UjiMinatAwal::getDataKategoriPsikometrik($riwayat_tes);

        $no = 1;
        foreach($riwayat_tes as $key=>$data_test){

            foreach($user as $key=>$user_data){
                
                if($user_data->email ==$data_test->users_email){
                    $datas=[
                        'id'=>$no,
                        'nama'=>$user_data->nama_depan." ".$user_data->nama_belakang,
                        'email'=>$user_data->email,
                        'jenis kelamin'=>$user_data->jenis_kelamin,
                        'pendidikan'=>$user_data->pendidikan_terakhir??"tidak ada",
                        'konsentrasi'=>$user_data->konsentrasi_pendidikan??"tidak ada",
                        'hobi'=>$user_data->hobi,
                        'tempat lahir'=>$user_data->tempat_lahir,
                        'tanggal lahir'=>$user_data->tanggal_lahir,
                        'usia'=>Carbon::now()->diffInYears(Carbon::parse($user_data->tanggal_lahir))." tahun",
                        'kota domisili'=>$user_data->kota,
                        'mulai test'=>$data_test->tanggal_mulai,
                        'selesai test'=>$data_test->tanggal_selesai,
               
                    ];
                }

            }
            foreach($dataKlaster as $d){
                if($data_test->klaster_id == $d->id){
                    $datas['rekomendasi klaster']=$d->nama;
                }

            }
            if($dataKategori[$data_test->id] != null){
                // foreach($dataKategori[$data_test->id] as $d){
                    $koma=implode(',',$dataKategori[$data_test->id]);
                  
                    // if(!$loop->last){
                      
                    // }
                    
                   // array_push($data_kategori,$koma);
                   
                // }
            }
            else {
                $koma= "Belum tes";
                //array_push($data_kategori,$koma);
            }
            //array_push($datas,$data_kategori);
            $datas['rekomendasi kategori']=$koma;
           
            array_push($seluruh_data,$datas);

            $no++;
        }

        return collect($seluruh_data);//collect(['user','riwayat_tes','dataKlaster','dataKategori']);
    }
    public function headings(): array{
        return [
            'Kode',
            'Nama Lengkap',
            'Email',
            'Jenis Kelamin',
            'Pendidikan',
            'Konsentrasi/Keahlian',
            'Hobi',
            'Kota Lahir',
            'Tanggal Lahir',
            'Usia',
            'Kota Domisili',
            'Mulai Tes',
            'Selesai Tes',
            'Rekomendasi Klaster',
            'Rekomendasi Kategori',

        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:O1')
                                ->getFont()
                                ->setBold(true);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(31);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(13);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(13);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('L')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('M')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('N')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('O')->setWidth(40);
            },
        ];
    }
}
