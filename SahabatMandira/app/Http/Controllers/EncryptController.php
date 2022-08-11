<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncryptController extends Controller
{
    public function encrypt_user_data(Request $request)
    {
        // $request to pull out image data
        $id_user = $request->id_dummy;
        $file = $request->file('dummyfile');

        $today = date("Y-m-d");
        $temp_foldername = $id_user.'-'.$today; 
        $encrypt_foldername = md5($temp_foldername);

        $path = 'assets/user_data/'.$encrypt_foldername;


        //UPLOAD
		// echo 'File Name: '.$file->getClientOriginalName();
		// echo '<br>';

        $encrypted_filename = md5($id_user."-".$file->getClientOriginalName());
 
		// echo 'File Extension: '.$file->getClientOriginalExtension();
		// echo '<br>';
 
		// echo 'File Real Path: '.$file->getRealPath();
		// echo '<br>';
 
		// echo 'File Size: '.$file->getSize();
		// echo '<br>';
 
		// echo 'File Mime Type: '.$file->getMimeType();
 

        //Directory checking & directory creation)
        if(!file_exists($path))
        {
            $make_dir = mkdir($path,0770, true);
            // if($make_dir)
            // {
            //     echo "Directory Created<br>";
            // }
        }

        $upload_filename = $encrypted_filename.".".$file->getClientOriginalExtension();
 
		$upload_fin = $file->move($path,$upload_filename);

        if($upload_fin)
        {
            echo "FILE SUCCESSFULLY UPLOADED";
        }
        else
        {
            echo "SORRY, THERE WAS AN ERROR WHILE UPLOADING YOUR FILE !";
        }

    }

}
