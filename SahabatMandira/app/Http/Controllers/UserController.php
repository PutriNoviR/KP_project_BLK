<?php

namespace App\Http\Controllers;

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
}
