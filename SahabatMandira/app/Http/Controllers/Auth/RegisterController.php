<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Role;
use App\Rules\Lowercase;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
    public function __construct(){
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
            'username' => ['required', 'alpha_dash', 'unique:users', new Lowercase],
            'nomer_hp' => ['required','digits_between:9,13'],
            'role' => ['required'],
            'email' => ['required', 'string', 'email:dns', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed','string', 'min:8', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[\W]).{8,}$/'],
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
                    Session::flash('recaptcha', 'please refresh browser');

                }
                // else{
                //     if($response->score < 0.5){
                //         $fail('Please refresh browser and try again!');
                //         Session::flash('recaptcha', 'please refresh browser');
                //     }
                // }
            }
        ],
        $messages = []
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $role = Role::where('nama_role', $data['role'])->first();
        // $role = Role::all();
        // dd($role);
        // $idRole = $role->id;
        $idRole = $role->id;
        // dd($idRole);

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
            'nomer_hp'=>$data['nomer_hp'],
            // 'alamat'=>$data['alamat'],
            // 'kota'=>$data['kota'],
            'username'=>strtolower($data['username']),
            'password' => Hash::make($data['password']),
            'roles_id' => $idRole,
            'countries_id' => $idCountry,
        ]);
    }
    public function regisMentor()
    {
        return view('auth.register');
    }
}
