<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SesiPelatihan;
use App\User;
use Illuminate\Support\Facades\Response;

class SertifikatController extends Controller
{
    //
    public function generate(Request $request)
    {
        $email_peserta = $request->email_user;
        $sesi_pelatihan_id = $request->id_sesi;

        $profil = User::find($email_peserta);
        $sesi_full = SesiPelatihan::JOIN('masterblk_db.paket_program as p','sesi_pelatihans.paket_program_id','p.id')
                    ->JOIN('masterblk_db.blks as b','p.blks_id','b.id')
                    ->JOIN('masterblk_db.sub_kejuruans as s','s.id','p.sub_kejuruans_id')
                    ->JOIN('pelatihan_pesertas as p','sesi_pelatihans.id','p.sesi_pelatihans_id')
                    ->WHERE('p.sesi_pelatihans_id','=',$sesi_pelatihan_id)
                    ->WHERE('p.email_peserta','=',$email_peserta)
                    ->select('sesi_pelatihans.*','b.*','s.nama as nama_program','p.hasil_kompetensi')
                    ->get();
        
        $data_upt = SesiPelatihan::JOIN('masterblk_db.paket_program as p','sesi_pelatihans.paket_program_id','p.id')
                    ->JOIN('masterblk_db.blks as b','p.blks_id','b.id')
                    ->JOIN('masterblk_db.kepalaupt as k','k.blks_id','b.id')
                    ->WHERE('sesi_pelatihans.id','=',$sesi_pelatihan_id)
                    ->select('k.*')
                    ->get();

        $link = "www.sahabatmandira.id";
        
        $base_qr = \QrCode::size(300)->format('png')->generate($link); 
        $base64 = 'data:image/png;base64,' . base64_encode($base_qr);
        // $base64= "www.sahabatmandira.id";

        return Response::json(['profil' => $profil, 'qr' => $base64, 'sesi_data' => $sesi_full, 'upt_data' => $data_upt]);
    }
}
