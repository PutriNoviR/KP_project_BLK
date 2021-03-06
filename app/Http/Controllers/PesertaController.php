<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Validation\Rule;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idRole = Role::where('nama_role', 'Peserta')->first();
        $data = User::where('roles_id', $idRole->id)->get();

        return view('admin.daftarPeserta', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if($request->tab == 'tab_1'){
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($request->email, 'email')],
                'no_hp' => ['required', 'numeric', 'digits:12'],
            ]);

            $peserta = [
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                "email" => $request->email,
                "nomer_hp" => $request->no_hp,
                "alamat" => $request->alamat,
                "kota" => $request->kota,
            ];
        }
        else if($request->tab == 'tab_2'){

            $data = User::where('email', $request->email)->first();
            $myname = $data->username;

            // ukuran dalam KB sehingga 20480 KB == 20 MB
    
            $this->validate($request, [
                'no_ktp' => ['required', 'mimes:png,jpeg,pdf', 'max:20480'],
                'ijazah' => ['required','mimes:png,jpeg,pdf', 'max:20480'],
                'ksk' => ['required', 'mimes:png,jpeg,pdf', 'max:20480'],
                'pas_foto' => ['required', 'mimes:png,jpeg,pdf', 'max:20480'],
            ]);
    
            $ksk= $request->file('ksk');
            $kskName = $myname.'_'.time().'_'.$ksk->getClientOriginalName();
            $ksk->move(public_path('images'),$kskName);
    
            $pas_foto= $request->file('pas_foto');
            $fotoName = $myname.'_'.time().'_'.$pas_foto->getClientOriginalName();
            $pas_foto->move(public_path('images'),$fotoName);

            $ktp= $request->file('no_ktp');
            $ktpName = $myname.'_'.time().'_'.$ktp->getClientOriginalName();
            $ktp->move(public_path('images'),$ktpName);
    
            $ijazah= $request->file('ijazah');
            $ijazahName = $myname.'_'.time().'_'.$ijazah->getClientOriginalName();
            $ijazah->move(public_path('images'),$ijazahName);
           
            $peserta = [
                "ktp" => $ktpName,
                'pas_foto' => $fotoName,
                'ksk'=> $kskName,
                "ijazah" => $ijazahName,
            ];
        }
        else{
            $this->validate($request, [
                'username'=>['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($request->email, 'email')],
                'no_identitas' => ['required', 'numeric', 'digits:16', Rule::unique('users', 'nomor_identitas')->ignore($request->email, 'email')],
      
            ]);

            if($request['tipe_identitas'] == "WNA"){
                $identitas = "Pasport";
                $idCountry = 2;
            }
            else{
                $identitas = "KTP";
                $idCountry = 1;
            }
    
            $peserta = [

                "nomor_identitas" => $request->no_identitas,
                'jenis_identitas' => $request->tipe_identitas,
                'username'=> $request->username,
                "password" => $request->password,
            ];
        }
        
        User::where('email', $request->email)->update($peserta);
        
        return redirect()->back()->with("status", "data telah diubah!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $email = $request->email;
        User::where('email',$email)->delete();

        return redirect()->back()->with("status", "data telah dihapus!");
    }

    public function getEditForm(Request $request){
        $data = User::where('email', $request->email)->first();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('admin.editPeserta', compact('data'))->render() 
        ), 200);
    }
}
