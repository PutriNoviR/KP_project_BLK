<?php

namespace App\Http\Controllers;

use App\Keahlian;
use App\KeahlianUser;
use Illuminate\Http\Request;

class KeahlianUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $keahlian = Keahlian::all();
        return view('keahlianUser.index',compact('keahlian'));
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
        $validatedData = $request->validate([
            'keahlian' => 'required',
        ]);

        $userLogin = auth()->user()->email;

        $keahlianuser = KeahlianUser::where('users_email',$userLogin);
        $keahlianuser->delete();

        foreach ($validatedData['keahlian'] as $keahlian) {
            $keahlianUser = new KeahlianUser();
            $keahlianUser->users_email = $userLogin;
            $keahlianUser->keahlians_idkeahlians = $keahlian;
            $keahlianUser->save();
        }
        return redirect()->back()->with('success', 'Data Keahlian berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KeahlianUser  $keahlianUser
     * @return \Illuminate\Http\Response
     */
    public function show(KeahlianUser $keahlianUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KeahlianUser  $keahlianUser
     * @return \Illuminate\Http\Response
     */
    public function edit(KeahlianUser $keahlianUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KeahlianUser  $keahlianUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {
        //
        $keahlianuser = KeahlianUser::where('users_email',$email);
        $keahlianuser->delete();

        $validatedData = $request->validate([
            'keahlian' => 'required',
        ]);

        $userLogin = auth()->user()->email;

        foreach ($validatedData['keahlian'] as $keahlian) {
            $keahlianUser = new KeahlianUser();
            $keahlianUser->users_email = $userLogin;
            $keahlianUser->keahlians_idkeahlians = $keahlian;
            $keahlianUser->save();
        }
        return redirect()->back()->with('success', 'Data Keahlian berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KeahlianUser  $keahlianUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(KeahlianUser $keahlianUser)
    {
        //
    }
}
