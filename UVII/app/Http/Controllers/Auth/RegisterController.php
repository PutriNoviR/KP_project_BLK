<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
  //  protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo(){
        Session::flash('success', 'Pendaftaran peserta berhasil');   
        return route("login");
    } 
 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:250'],
            'lastname' => ['required', 'string', 'max:250'],
            'username' => ['required', 'string', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed','string', 'min:8'],
            'nomer' => ['required', 'numeric', 'min:10'],
            'g-recaptcha-response' => function($attribute, $value, $fail){
                $secretKey = config('services.recaptcha.secret');
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $response = \file_get_contents($url);
                // decode response
                $response = json_decode($response);
                
                if(!$response->success){
                    $fail('please check the recaptcha');
                    Session::flash('recaptcha', 'please check the recaptcha');

                }
            }
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $role = Role::where('nama_role', $data['peran'])->first();
        
        $idRole = $role->id;

        // $identitas = "";
        $idCountry = 1;

        // if($data['tipe_identitas'] == "WNA"){
        //     $identitas = "Pasport";
        //     $idCountry = 2;
        // }
        // else{
        //     $identitas = "KTP";
        //     $idCountry = 1;
        // }

        return User::create([
            // 'nomor_identitas' => $data['nomor_identitas'],
            // 'jenis_identitas' => $identitas,
            'nama_depan' => $data['firstname'],
            'nama_belakang' => $data['lastname'],
            'email' => $data['email'],
            'nomer_hp'=>$data['nomer'],
            // 'alamat'=>$data['alamat'],
            // 'kota'=>$data['kota'],
            'username'=>$data['username'],
            'password' => Hash::make($data['password']),
            'rolemandira_id' => $idRole,
            'countries_id' => $idCountry,
        ]);
    }

}
