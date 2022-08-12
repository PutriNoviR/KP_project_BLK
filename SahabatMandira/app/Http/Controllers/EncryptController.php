<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EncryptController extends Controller
{
    public function encrypt_user_data(Request $request)
    {
        // $request to pull out image data
        $id_user = Auth::user()->username;
        $ksk= $request->file('ksk');
        $pas_foto= $request->file('pas_foto');
        $ktp= $request->file('no_ktp');
        $ijazah= $request->file('ijazah');

        $temp_foldername = $id_user; 
        $encrypt_foldername = md5($temp_foldername);

        $path = 'assets/user_data/'.$encrypt_foldername;

        $encrypted_ksk = md5($id_user.'_'.time().'_'.$ksk->getClientOriginalName());
        $encrypted_foto = md5($id_user.'_'.time().'_'.$pas_foto->getClientOriginalName());
        $encrypted_ktp = md5($id_user.'_'.time().'_'.$ktp->getClientOriginalName());
        $encrypted_ijazah = md5($id_user.'_'.time().'_'.$ijazah->getClientOriginalName());
 
        //Directory checking & directory creation)
        if(!file_exists($path))
        {
            $make_dir = mkdir($path,0770, true);
        }

        $upload_filename_ksk = $encrypted_ksk.".".$ksk->getClientOriginalExtension();
        $upload_filename_foto = $encrypted_foto.".".$pas_foto->getClientOriginalExtension();
        $upload_filename_ktp = $encrypted_ktp.".".$ktp->getClientOriginalExtension();
        $upload_filename_ijazah = $encrypted_ijazah.".".$ijazah->getClientOriginalExtension();


 
		$upload_fin_ksk = $ksk->move($path,$upload_filename_ksk);
        $upload_fin_foto = $pas_foto->move($path,$upload_filename_foto);
        $upload_fin_ktp = $ktp->move($path,$upload_filename_ktp);
        $upload_fin_ijazah = $ijazah->move($path,$upload_filename_ijazah);

        // if($upload_fin_ksk  && $upload_fin_foto && $upload_fin_ktp && $upload_fin_ijazah)
        // {
        //     echo "FILE SUCCESSFULLY UPLOADED";
        // }
        // else
        // {
        //     echo "SORRY, THERE WAS AN ERROR WHILE UPLOADING YOUR FILE !";
        // }
    }

}
