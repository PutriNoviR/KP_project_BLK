<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Rules\LowercaseRule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Role::all();
         // -- menu manajemen --
         $role_user = Auth::user()->roles_id;
         $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                         ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                         ->select('mm.nama', 'mm.url')
                         ->where('roles_id', $role_user)
                         ->where('mm.status','Aktif')
                         ->get();
 
         return view('role.index', compact('data','menu_role'));
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
        $this->validate($request, [
            'nama' => ['required', 'string', 'max:45', Rule::unique('roles', 'nama_role')],
            'deskripsi' => ['required', 'string', 'max:250'],
        ]);
        
        $role = new Role();
     
        $role->nama_role = $request->nama;
        $role->deskripsi = $request->deskripsi;
        
        $role->save();
        
        return redirect()->back()->with("success", "Role berhasil ditambah!");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'nama' => ['required', 'string', 'max:45', Rule::unique('roles', 'nama_role')->ignore($role->id, 'id')],
            'deskripsi' => ['required', 'string', 'max:250'],
        ]);
     
        $role->nama_role = $request->nama;
        $role->deskripsi = $request->deskripsi;
        
        $role->save();
        
        return redirect()->back()->with("success", "Role berhasil diubah!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try{
            $role->delete();
            return redirect()->back()->with('status','Role berhasil dihapus');
        }catch (\PDOException $e) {
            $msg="Data gagal dihapus. Pastikan data child sudah hilang atau tidak berhubungan";

            return redirect()->back()->with('error',$msg);
        }
    }

    public function getEditForm(Request $request){
        // find untuk mencari data id
        $data = Role::find($request->roleId);

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('role.edit', compact('data'))->render() 
        ), 200);
    }
    
    public function showAdmin(){
        // -- menu manajemen --
        $role_user = Auth::user()->roles_id;
        $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                        ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                        ->select('mm.nama', 'mm.url')
                        ->where('roles_id', $role_user)
                        ->where('mm.status','Aktif')
                        ->get();

        $idRole = Role::where('nama_role', 'adminuvii')->first();
        $data = User::where('roles_id', $idRole->id)->get();

        return view('admin.tambahAdmin', compact('data','menu_role'));
    }

    public function tambahAdmin(Request $request){

        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'no_hp' => ['required', 'numeric', 'digits_between:10,12'],
            'username' => ['required', 'string', 'alpha_dash', new LowercaseRule, 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:8', 'regex:/^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/']
        ]);

        $admin = new User();
        $admin->email = $request->email;
        $admin->nama_depan = $request->nama_depan;
        $admin->nama_belakang = $request->nama_belakang;
        $admin->nomer_hp = $request->no_hp;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);

        $role = Role::where('nama_role','adminuvii')->first();

        $admin->roles_id = $role->id;
        $admin->countries_id = 1;

        $admin->save();

        return redirect()->back()->with('success','admin berhasil ditambah!');
    }

    public function getEditAdmin(Request $request){
        $email = $request->email;
        $data = User::where('email',$email)->first();

        return response()->json(array(
            'status'=>'oke',
            //  'msg'=>$data->username
            'msg'=>view('admin.editAdmin', compact('data'))->render() 
        ), 200);
    }

    public function updateAdmin(Request $request){
       
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($request->email, 'email')],
            'no_hp' => ['required', 'numeric', 'digits_between:10,12'],
            'username' => ['required', 'string', 'alpha_dash', new LowercaseRule,Rule::unique('users', 'username')->ignore($request->username, 'username')],
        ]);

        $admin=[
            'email' => $request->email,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'nomer_hp' => $request->no_hp,
            'username' => $request->username,
            'kota' => $request->kota,
            'alamat' => $request->alamat
        ];

        User::where('email', $request->old_email)->update($admin);

        return redirect()->back()->with('success','admin berhasil diubah!');
       
    }

    public function deleteAdmin(Request $request){
        try{
            User::where('email', $request->email)->delete();
          
            return redirect()->back()->with('status','admin berhasil dihapus');
        }catch (\PDOException $e) {
            $msg="Data gagal dihapus. Pastikan data child sudah hilang atau tidak berhubungan";

            return redirect()->back()->with('error',$msg);
        }
    }
}
