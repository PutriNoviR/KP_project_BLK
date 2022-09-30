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
                    ->WHERE('sesi_pelatihans.id','=',$sesi_pelatihan_id)
                    ->select('sesi_pelatihans.*','b.*','s.nama as nama_program')
                    ->get();

        $link = "www.sahabatmandira.id";
        
        $base_qr = \QrCode::size(300)->format('png')->generate($link); 
        $base64 = 'data:image/png;base64,' . base64_encode($base_qr);

        return Response::json(['profil' => $profil, 'sesi_data' => $sesi_full, 'qr' => $base64]);
    }
}
