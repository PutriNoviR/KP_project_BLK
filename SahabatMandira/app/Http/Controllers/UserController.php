<?php

namespace App\Http\Controllers;

use App\Blk;
use App\Keahlian;
use App\MandiraMentoring;
use App\PaketProgram;
use App\PelatihanPeserta;
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
    public function show($email)
    {
        //
        $data = User::find($email);

        // $pelatihan = PelatihanPeserta::WHERE('status_fase','!=','NULL')
        // ->ORDERBY('tanggal_seleksi','asc')
        // ->first()
        // ->get();
        // $a = 'halo';
        // dd($a);
        return view('user.profile', compact('data',));
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
        $data = SesiPelatihan::where('id', $request->idPelatihan)->get();
        $userLogin = auth()->user()->email;
        $cekDaftar = PelatihanPeserta::where('sesi_pelatihans_id', '=', $request->idPelatihan)
            ->where('email_peserta', '=', $userLogin)->get();
        // dd($data->paketprogram);
        $User = User::find($request->id);
        $validator = $request->validate([
            'pas_foto' => ['required', 'mimes:png,jpg'],
            'fotoKtp' => ['required', 'mimes:png,jpg,pdf'],
            'ksk' => ['required', 'mimes:png,jpg,pdf'],
            'ijazah' => ['required', 'mimes:png,jpg,pdf'],
            'nomorIdentitas' => ['required', 'string', 'min:16', 'max:16'],
            'nomorHp' => ['required', 'string', 'min:12']
        ]);
        // dd($request);
        $User->jenis_identitas = $request->jenis_identitas;
        $User->pas_foto = $request->file('pas_foto')->store('user/pas_foto');
        $User->nomor_identitas = $request->nomorIdentitas;
        $User->nomer_hp = $request->nomorHp;
        $User->kota = $request->kota;
        $User->alamat = $request->alamat;
        $User->ktp = $request->file('fotoKtp')->store('user/ktp');
        $User->ksk = $request->file('ksk')->store('user/ksk');
        $User->ijazah = $request->file('ijazah')->store('user/ijazah');
        $User->jenis_kelamin = $request->jenis_kelamin;
        $User->pendidikan_terakhir = $request->pendidikan_terakhir;


        $User->save();
        return view('sesipelatihan.detailPelatihan', compact('data', 'cekDaftar'));
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
        return view('admin.daftarAdminBlk', compact('adminblks', 'blks'));
    }

    public function tambahAdminBlk(Request $request)
    {
        $adminblk = User::where('email', $request->email)->first();
        if ($adminblk == null) {
            return redirect()->back()->with('failed', 'Data user tidak ditemukan!');
        }
        $role = Role::where('nama_role', 'adminblk')->first();

        $adminblk->blks_id_admin = $request->blks_id;
        $adminblk->roles_id = $role->id;
        $adminblk->save();
        return redirect()->back()->with('success', 'Admin BLK berhasil ditambahkan!');
    }

    public function editAdminBlk(Request $request)
    {
        $admin = User::where('email', $request->email)->first();
        $admin->blks_id_admin = $request->blks_id;
        $admin->save();
        return redirect()->back()->with('success', 'Admin BLK berhasil diubah!');
    }

    public function hapusAdminBlk($email)
    {
        $role = Role::where('nama_role', 'peserta')->first();
        $user = User::where('email', $email)->first();
        // dd($user);
        $user->blks_id_admin = null;
        $user->roles_id = $role->id;
        $user->save();

        return redirect()->back()->with('success', 'Admin BLK berhasil dihapus!');
    }

    public function getEditForm(Request $request)
    {
        $user = User::find($request->id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('user.modal', compact('user'))->render()
        ), 200);
    }

    public function getEditFormAdminBlk(Request $request)
    {
        $blks = Blk::all();
        $admin = User::where('email', $request->email)->first();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.editModalAdminBlk', compact('admin', 'blks'))->render()
        ), 200);
    }

    public function kelengkapanDokumen(Request $request)
    {
        $user = new User();
        $user->jenis_identitas = $request->jenis_identitas;
        $user->nomor_identitas = $request->nomorIdentitas;
        $user->nomer_hp = $request->nomorHp;
        $user->kota = $request->kota;
        $user->alamat = $request->alamat;
        $user->pas_foto = $request->pas_foto;
        $user->ktp = $request->fotoKtp;
        $user->ksk = $request->ksk;
        $user->ijazah = $request->ijazah;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->pendidikan_terakhir = $request->pendidikan_terakhir;
    }

    public function daftar()
    {

        $adminBlk = auth()->user()->blks_id_admin;

        if (auth()->user()->role->nama_role == 'adminblk') {
            $data = User::JOIN('mandira_db.pelatihan_pesertas as p', 'users.email', '=', 'p.email_peserta')
                ->JOIN('mandira_db.sesi_pelatihans as s', 's.id', '=', 'p.sesi_pelatihans_id')
                ->JOIN('paket_program as m', 's.paket_program_id', '=', 'm.id')
                ->WHERE('m.blks_id', '=', $adminBlk)
                ->get();
        } else {
            $data = User::JOIN('roles as r', 'r.id', '=', 'users.roles_id')
                ->where('r.nama_role', '=', 'peserta')->get();
        }
        // dd($dataAdmin);
        return view('user.peserta', compact('data'));
    }

    public function mentordaftar()
    {
        $data = User::JOIN('roles as r', 'r.id', '=', 'users.roles_id')
            ->where('r.nama_role', '=', 'mentor')
            ->get();
        // dd($data);
        return view('keahlian.peserta', compact('data'));
    }

    public function suspendUser($email)
    {
        $userLogin = auth()->user()->email;
        $User = User::find($email);
        // dd($User);
        // $check = $request->check;
        if ($User->is_suspend == '1') {
            $User->is_suspend = 0;
        } else {
            $User->is_suspend = 1;
        }

        $User->suspended_by = $userLogin;
        $User->save();
        return redirect()->back()->with('success', 'Suspend Peserta berhasil diubah!');
    }

    public function halamanMentor($email)
    {
        $userLogin = auth()->user()->email;
        $user = User::find($email);
        $daftarKeahlian = Keahlian::JOIN('keahlian_users as k', 'k.keahlians_idkeahlians', '=', 'keahlians.idkeahlians')
            ->where('users_email', '=', $userLogin)->get();
        $mentoring = MandiraMentoring::where('email_mentor', $userLogin)->first();
        return view('mentor.profile', compact('user', 'mentoring','daftarKeahlian'));
    }
}
