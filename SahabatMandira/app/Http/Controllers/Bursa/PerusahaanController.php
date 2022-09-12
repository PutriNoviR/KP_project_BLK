<?php

namespace App\Http\Controllers\Bursa;

use App\Perusahaan;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;

class PerusahaanController extends Controller
{
    /**
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

    // public function posting()
    // {
    //     //compact untuk kirim data
    //     $lowongan = Lowongan::all();
    //     return view("welcome", compact("lowongan"));
    // }
}
