<?php

namespace App\Http\Controllers;

use App\Blk;
use App\PaketProgram;
use App\Role;
use App\SesiPelatihan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = User::all();
        // dd($data);
        return view('user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view();
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
        $User = new User();
        $User->email = $request->email;
        $User->nama_depan = $request->nama_depan;
        $User->nama_belakang = $request->nama_belakang;
        $User->username = $request->username;
        $User->password = bcrypt($request->password);
        $User->countries_id = $request->countries_id;
        $User->roles_id = $request->roles_id;
        $User->jenis_identitas = $request->jenis_identitas;
        $User->pas_foto = $request->pas_foto;
        $User->nomor_identitas = $request->nomor_identitas;
        $User->nomer_hp = $request->nomer_hp;
        $User->kota = $request->kota;
        $User->alamat = $request->alamat;
        $User->ktp = $request->ktp;
        $User->ksk = $request->ksk;
        $User->ijazah = $request->ijazah;
        $User->jenis_kelamin = $request->jenis_kelamin;
        $User->pendidikan_terakhir = $request->pendidikan_terakhir;
        $User->save();
        return view();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        //
        return view($data = $User);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        //
        return view($data = $User);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        //
        // dd($User, $request->id);
        // $this->validate($request, [
        //     'pas_foto' => ['required'],
        //     'nomorIdentitas' => ['required','numeric', 'digits:16'],
        //     'nomorHp' => ['required','numeric','digits:12'],
        //     'kota' => ['required', 'string'],
        //     'alamat' => ['required','string'],
        //     'fotoKtp' => ['required'],
        //     'ksk' => ['requied'],
        //     'ijazah' => ['required'],
        //     'jenis_kelamin' => ['required']

        // ]);
        $data = SesiPelatihan::where('id',$request->idPelatihan)->get();
        // dd($data->paketprogram);
        $User =User::find($request->id);
        $validator = $request->validate([
            'nomorIdentitas' => ['required', 'string', 'min:16', 'max:16'],
            'nomorHp' => ['required', 'string', 'min:12', 'max:12']
        ]);
        // dd($request);
        $User->jenis_identitas = $request->jenis_identitas;
        $User->pas_foto = $request->pas_foto;
        $User->nomor_identitas = $request->nomorIdentitas;
        $User->nomer_hp = $request->nomorHp;
        $User->kota = $request->kota;
        $User->alamat = $request->alamat;
        $User->ktp = $request->fotoKtp;
        $User->ksk = $request->ksk;
        $User->ijazah = $request->ijazah;
        $User->jenis_kelamin = $request->jenis_kelamin;
        $User->pendidikan_terakhir = $request->pendidikan_terakhir;
        // $User->save();
        return view('sesipelatihan.detailPelatihan',compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        //
        $User->delete();
        return view();
    }

    public function daftarAdminBlk()
    {
        $blks = Blk::all();
        $adminblks = User::whereNotNull('blks_id_admin')->get();
        return view('admin.daftarAdminBlk', compact('adminblks','blks'));
    }

    public function tambahAdminBlk(Request $request)
    {
        $adminblk = User::where('email',$request->email)->first();
        if ($adminblk == null) {
            return redirect()->back()->with('failed','Data user tidak ditemukan!');
        }
        $role = Role::where('nama_role','adminblk')->first();

        $adminblk->blks_id_admin = $request->blks_id;
        $adminblk->roles_id = $role->id;
        $adminblk->save();
        return redirect()->back()->with('success','Admin BLK berhasil ditambahkan!');
    }

    public function editAdminBlk(Request $request)
    {
        $admin = User::where('email',$request->email)->first();
        $admin->blks_id_admin = $request->blks_id;
        $admin->save();
        return redirect()->back()->with('success','Admin BLK berhasil diubah!');
    }

    public function hapusAdminBlk($email)
    {
        $role = Role::where('nama_role','peserta')->first();
        $user = User::where('email',$email)->first();
        // dd($user);
        $user->blks_id_admin = null;
        $user->roles_id = $role->id;
        $user->save();

        return redirect()->back()->with('success','Admin BLK berhasil dihapus!');
    }

    public function getEditForm(Request $request)
    {
        $user = User::find($request->id);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('user.modal', compact('user'))->render()
        ), 200);
    }

    public function getEditFormAdminBlk(Request $request)
    {
        $blks = Blk::all();
        $admin = User::where('email',$request->email)->first();
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('admin.editModalAdminBlk', compact('admin','blks'))->render()
        ), 200);
    }

    public function kelengkapanDokumen(Request $request){
        $user = new User();
        $user->jenis_identitas=$request->jenis_identitas;
        $user->nomor_identitas=$request->nomorIdentitas;
        $user->nomer_hp=$request->nomorHp;
        $user->kota=$request->kota;
        $user->alamat=$request->alamat;
        $user->pas_foto=$request->pas_foto;
        $user->ktp=$request->fotoKtp;
        $user->ksk=$request->ksk;
        $user->ijazah=$request->ijazah;
        $user->jenis_kelamin=$request->jenis_kelamin;
        $user->pendidikan_terakhir=$request->pendidikan_terakhir;
    }

    public function daftarPeserta()
    {
        $data = User::JOIN('roles as r', 'r.id', '=', 'users.roles_id')
        ->where('r.nama_role','=','peserta')->get();
        // dd($data);
        return view('user.peserta', compact('data'));
    }
}
