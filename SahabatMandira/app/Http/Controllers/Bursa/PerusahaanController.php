<?php

namespace App\Http\Controllers\Bursa;

use App\Perusahaan;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\DokumenPerusahaan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;

class PerusahaanController extends Controller
{
    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $data = Perusahaan::all();
        return view('perusahaan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::user()->perusahaans_id_admin != null) {
            return redirect()->route('perusahaan.profile');
        }
        return view ("perusahaan.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $validatedData = $request->validate([
            'namaperusahaan' => 'required|max:200',
            'bidang' => ' required|max:200', 
            'kota' => ' required|max:200', 
            'alamat' => 'required|max:200',
            'kode_pos' => 'required|digits:5',
            'no_telp' => 'required|max:12',
            'emailperusahaan' => 'required|max:250',
            'tentang_perusahaan' => 'required',
            // 'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // dd($request);

        // $validatedData['logo'] = $request->file('logo')->store('logo');
        // $validatedData['foto_perusahaan'] = $request->file('foto_perusahaan')->store('foto_perusahaan');
        // $validatedData['siup'] = $request->file('siup')->store('siup');
        // $validatedData['npwp'] = $request->file('npwp')->store('npwp');

        $perusahaan = new Perusahaan();
        $perusahaan->nama=$validatedData['namaperusahaan'];
        $perusahaan->bidang=$validatedData['bidang'];
        $perusahaan->kota=$validatedData['kota'];
        $perusahaan->alamat=$validatedData['alamat'];
        $perusahaan->kode_pos=$validatedData['kode_pos'];
        $perusahaan->no_telp=$validatedData['no_telp'];
        $perusahaan->email=$validatedData['emailperusahaan'];
        $perusahaan->logo="logo/default.png";
        // $perusahaan->images=$validatedData['foto_perusahaan'];
        // $perusahaan->siup=$validatedData['siup'];
        // $perusahaan->npwp=$validatedData['npwp'];
        $perusahaan->tentang_perusahaan=$validatedData['tentang_perusahaan'];
        $perusahaan->save();

        $user = User::where('email',Auth::user()->email)->first();
        $user->perusahaans_id_admin = $perusahaan->id;
        $user->save();
        return redirect()->route("perusahaan.profile")->with('success','Pendaftaran perusahaan berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Perusahaan $perusahaan)
    {
        //
        return view('perusahaan.update',compact('perusahaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        //
        // dd($request,$perusahaan);
        $perusahaan->nama=$request->nama_perusahaan;
        $perusahaan->bidang=$request->bidang_perusahaan;
        $perusahaan->kota=$request->kota_perusahaan;
        $perusahaan->alamat=$request->alamat_perusahaan;
        $perusahaan->kode_pos=$request->kodepos_perusahaan;
        $perusahaan->tentang_perusahaan=$request->tentang_perusahaan;
        $perusahaan->save();
        return redirect()->route('perusahaan.profile')->with('success', 'Data perusahaan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perusahaan $perusahaan)
    {
        //
        try {
            $perusahaan->delete(); 
            return redirect()->route('perusahaan.index')->with('success','Data Perusahaan berhasil dihapus!');
        } catch (\PDOException $e) {
            $msg="Data gagal dihapus";

            return redirect()->route('perusahaan.index')->with('error',$msg);
        }
    }

    public function getEdit(Request $request)
    {
        $perusahaan = Perusahaan::find($request->id);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('perusahaan.modal', compact('perusahaan'))->render() 
        ), 200);
    }

    public function profile()
    {
        $perusahaan = Perusahaan::where('id', Auth::user()->perusahaans_id_admin)->first();
        // dd($perusahaan);
        return view('perusahaan.profile',compact('perusahaan'));
    }

    public function editFoto(Request $request)
    {
        $folderPath = storage_path('app/public/logo/');
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $filename = uniqid() . '.'.$image_type;
        $logo = "$folderPath$filename";
        file_put_contents($logo, $image_base64);

        $perusahaan = Perusahaan::where('id', Auth::user()->perusahaans_id_admin)->first();
        $perusahaan->logo = "logo/$filename";
        $perusahaan->save();
        // dd($perusahaan);
        return response()->json(array(
            'status'=>'oke',
        ),200);
    }

    public function uploadDokumen(Request $request){

        //NPWP
        $npwp = $request->file('NPWP');
        //Tempat File akan disimpan
        $folderPathNpwp = storage_path('app/public/npwp/');
        //GET Nama File yang upload
        $filenameWithExt = $request->file('NPWP')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //Get Jenis file ex : pdf
        $extension = $request->file('NPWP')->getClientOriginalExtension();
        //Tambah Namafile denggan tanggal
        $fileNameToStore = $filename.'-'.time().'.'.$extension;
        //Mengganti Spasi dengan '_'
        $namesave = str_replace(" " , "_" , $fileNameToStore);
        //Simpan FIle ke Storage
        $npwp->move($folderPathNpwp, $namesave);

        //ADD Data On databse
        $cekNPWP = DokumenPerusahaan::where('perusahaans_id',Auth::user()->perusahaans_id_admin)->where('nama','NPWP')->first();
        // dd($cekNPWP);
        if($cekNPWP != null){
            $cekNPWP->nama = 'NPWP';
            $cekNPWP->value = $namesave;
            $cekNPWP->perusahaans_id = Auth::user()->perusahaans_id_admin;
            $cekNPWP->save();
        }
        else{
            $dokumenNpwp = new DokumenPerusahaan();
            $dokumenNpwp->nama = 'NPWP';
            $dokumenNpwp->value = $namesave;
            $dokumenNpwp->perusahaans_id = Auth::user()->perusahaans_id_admin;
            $dokumenNpwp->save();
        }

        //SIUP
        $siup = $request->file('SIUP');
        $folderPathSiup = storage_path('app/public/siup/');

        $filenameWithExt2 = $request->file('SIUP')->getClientOriginalName();
        $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
        $extension2 = $request->file('SIUP')->getClientOriginalExtension();
        $fileNameToStore2 = $filename2.'-'.time().'.'.$extension2;
        $namesave2 = str_replace(" " , "_" , $fileNameToStore2);

        $siup->move($folderPathSiup, $namesave2);

        $cekSIUP = DokumenPerusahaan::where('perusahaans_id', Auth::user()->perusahaans_id_admin)->where('nama','SIUP')->first();

        if($cekSIUP != null){
            $cekSIUP->nama = 'SIUP';
            $cekSIUP->value = $namesave2;
            $cekSIUP->perusahaans_id = Auth::user()->perusahaans_id_admin;
            $cekSIUP->save();
        }
        else{
        $dokumenSiup = new DokumenPerusahaan();
        $dokumenSiup->nama = 'SIUP';
        $dokumenSiup->value = $namesave2;
        $dokumenSiup->perusahaans_id = Auth::user()->perusahaans_id_admin;
        $dokumenSiup->save();
        }

        //NIB
        $cekNIB = DokumenPerusahaan::where('perusahaans_id', Auth::user()->perusahaans_id_admin)->where('nama','NIB')->first();
        
        if($cekNIB != null){
            $cekNIB->nama = 'NIB';
            $cekNIB->value = $request->get('NIB');
            $cekNIB->perusahaans_id = Auth::user()->perusahaans_id_admin;
            $cekNIB->save();
        }
        else{
            $dokumenNib = new DokumenPerusahaan();
            $dokumenNib->nama = 'NIB';
            $dokumenNib->value = $request->get('NIB');
            $dokumenNib->perusahaans_id = Auth::user()->perusahaans_id_admin;
            $dokumenNib->save();
        }
        

        return redirect()->route('perusahaan.profile')->with('success', 'Data perusahaan berhasil diubah!');
    }

    public function getDokumen()
    {
        // $perusahaan = Perusahaan::all();
        //
        $perusahaan = Perusahaan::where('verified_by',null)->get();
        // dd($perusahaan);
        return view('perusahaan.dokumen', compact('perusahaan'));
    }

    public function validasiPerusahaan($id)
    {
        $perusahaan = Perusahaan::find($id);
        $perusahaan->verified_by = Auth::user()->role->nama_role = 'superadmin';
        $perusahaan->save();

        return redirect()->back()->with('success', 'Perusahaan divalidasi!');
    }

    public function semuadata()
    {
        // $perusahaan = Perusahaan::all();
        //
        $perusahaan = Perusahaan::all();
        // dd($perusahaan);
        return view('perusahaan.semuadata', compact('perusahaan'));
    }

    public function download($file){

        $item = explode('^' , $file);
        $nama = $item[0];
        $fileName = $item[1];

        // dd($fileName);

        return response()->download(storage_path('app/public/'.$nama.'/'.$fileName));
     }
}
