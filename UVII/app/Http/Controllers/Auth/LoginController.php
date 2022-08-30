<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/";
    protected $username;

    // public function redirectTo(){
    //     $role = Auth::user()->role->nama_role;
    //     switch($role){
    //         case 'Admin':
    //             return '/admin';
    //             break;
    //         case 'Peserta':
    //             return '/';
    //             break;

    //         default:
    //             return '/';
    //             break;
    //     }
    // }
    
     
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // untuk mengganti login dari email menjadi username
    public function username(){
        return 'username';
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
