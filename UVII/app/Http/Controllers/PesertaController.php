<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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

        $role_user = Auth::user()->roles_id;
        $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                    ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                    ->select('mm.nama', 'mm.url')
                    ->where('roles_id', $role_user)
                    ->where('mm.status','Aktif')
                    ->get();

        return view('admin.daftarPeserta', compact('data', 'menu_role'));
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

            if($request->tipe_identitas == "Pasport"){
                $identitas = "Pasport";
               
            }
            else{
                $identitas = "KTP";
                
            }
    
            $peserta = [

                "nomor_identitas" => $request->no_identitas,
                'jenis_identitas' => $identitas,
                'username'=> $request->username,
                "password" => $request->password,
            ];
        }
        
        User::where('email', $request->old_email)->update($peserta);
  
        $dataUjiMinat = User::find($request->old_email)->ujiMinatAwals()->get();
        
       
        if($dataUjiMinat){
            User::find($request->old_email)->ujiMinatAwals()->update(['users_email'=>$request->email]);
        }
       
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
        try{
            $email = $request->email;
            User::where('email',$email)->delete();
    
            return redirect()->back()->with("status", "data telah dihapus!");
        }
       catch(\PDOException $e){
            $msg="Data gagal dihapus. Pastikan data child sudah hilang atau tidak berhubungan";

            return redirect()->back()->with('error',$msg);
       }
    }

    public function getEditForm(Request $request){
        $data = User::where('email', $request->email)->first();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('admin.editPeserta', compact('data'))->render() 
        ), 200);
    }

    public function kelengkapanDataPribadi(Request $request){
        $this->validate($request, [
            'nomor_identitas' => ['required', 'numeric', 'digits:16', 'unique:users'],
        ]);

        // $data = $request->session()->get('kelengkapanData');

        // if(empty($data)){
           
            $data=[
                "nomor_identitas" => $request->nomor_identitas,
                "jenis_identitas" => $request->jenis_identitas,
                "jenis_kelamin" => $request->jenis_kelamin,
                "hobi" => $request->hobi,
                "tanggal_lahir" => $request->tanggal_lahir,
                "pendidikan_terakhir" => $request->pendidikan_terakhir,
                "alamat" => $request->alamat,
                "kota" => $request->kota,
            ];

            $myemail = Auth::user()->email;
            // setelah next sistem akan langsung update 
            User::where('email', $myemail)->update($data);

            // $request->session()->put('kelengkapanData', $data);
        // }
        
        return redirect()->route('home');
    }

    public function kelengkapanDataDokumen(Request $request){
        $myname = Auth::user()->username;

        // $data = $request->session()->get('kelengkapanData');

        // if(!isset($data['ktp'])){
            $this->validate($request, [
                'no_ktp' => ['required', 'mimes:png,jpeg,pdf', 'max:20480'],
                'ijazah' => ['required','mimes:png,jpeg,pdf', 'max:20480'],
                'ksk' => ['required', 'mimes:png,jpeg,pdf', 'max:20480'],
                'pas_foto' => ['required', 'mimes:png,jpeg,pdf', 'max:20480'],
            ]);

            // Format nama file awalnya belum fix: username_waktu_nama file
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

            $data=[
                'ktp' => $ktpName,
                'ijazah' => $ijazahName,
                'ksk' => $kskName,
                'pas_foto' => $fotoName,
            ];

            // $request->session()->put('kelengkapanData', $data);

            User::where('username', $myname)->update($data);

            // $request->session()->forget('kelengkapanData');
        // }  
        
        return redirect()->route('home');
    }

    public function forgotPasswords(Request $request){
        if($request->password == $request->password_confirmation){
            User::where('email',$request->email)->update(['password'=>Hash::make($request->password)]);
            return redirect()->route('login')->with('success','Password Berhasil dirubah');
        }
        else{
            return redirect()->back()->with('error','password gagal terganti');
        }

    }
    public function getForgotPasswords(){
        return view('auth.passwords.reset');

    }

    public function getProfile(){
        $role_user = Auth::user()->roles_id;
        $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                    ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                    ->select('mm.nama', 'mm.url')
                    ->where('roles_id', $role_user)
                    ->where('mm.status','Aktif')
                    ->get();
            
        $data = Auth::user();
    
        return view('admin.profile', compact('data','menu_role'));
    }
}
