<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    public function redirectTo(){
        $role = Auth::user()->role->nama_role;
        
        if($role != 'adminuvii' && $role != 'peserta'){
            Auth::logout();
            return route("login"); 
        }
        else{
            return route("home");
        }
    }
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

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required', 
            'password' => 'required',
            // recaptcha
            'g-recaptcha-response' => function($attribute, $value, $fail){
                $secretKey = config('services.recaptcha.secret');
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                // $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $url = "https://www.google.com/recaptcha/api/siteverify";
                $data = [
                    'secret'=>$secretKey,
                    'response'=>$response,
                    'remoteip'=>$userIP
                ];
                $option=[
                    'http' => [
                        'header' => "Content-type:application/x-www-form-urlencoded\r\n",
                        'method' => 'POST',
                        'content' => http_build_query($data) 
                    ]
                ];

                $context = stream_context_create($option);

                $response = \file_get_contents($url, false, $context);
                // decode response
                $response = json_decode($response);
           
                if(!$response->success){
                    $fail('Please refresh browser and try again!');
                    // Session::flash('recaptcha', 'please refresh browser');

                }
                
                else{
                    if($response->score < 0.6){
                        $fail('Please refresh browser and try again!');
                        // Session::flash('recaptcha', 'please refresh browser');
                    }
                }
                
                

            }
        ]);
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
