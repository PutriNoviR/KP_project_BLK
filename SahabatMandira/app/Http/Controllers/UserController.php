<?php

namespace App\Http\Controllers;

use App\Blk;
use App\Role;
use App\User;
use Illuminate\Http\Request;

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
        return view();
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
        $User->email = $request->email;
        $User->nama_depan = $request->nama_depan;
        $User->nama_belakang = $request->nama_belakang;
        $User->username = $request->username;
        $User->password = bcrypt($request->password);
        $User->countries_id = $request->countries_id;
        $User->roles_id = $request->roles_id;
        $User->save();
        return view();
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

        dd($adminblk);
        $adminblk->blks_id_admin = $request->blks_id;
        $adminblk->roles_id = $role->id; 
        $adminblk->save();
        return redirect()->back()->with('success','Admin BLK berhasil ditambahkan!');
    }

    public function getEditFormAdminBlk(Request $request)
    {
        
    }
}
