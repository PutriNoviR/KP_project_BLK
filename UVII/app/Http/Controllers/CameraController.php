<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CameraController extends Controller
{
    function camera(){
        return view('webcam');
    }

    function capture(){
        $img = $request->get('image');
        $folderPath = "camera/";

        // dd($img);

        $image_parts = explode(';base64,',$img);
        $image_type_aux = explode('image/', $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $filename = uniqid().'.png';

        $file = $folderPath.$filename;

        file_put_contents($file,$image_base64);

        return response()->json(array(
            'msg' => 'Berhasil'
        ), 200);
    }
}
