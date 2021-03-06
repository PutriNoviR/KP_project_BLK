<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        return view('role.index', compact('data'));
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
}
