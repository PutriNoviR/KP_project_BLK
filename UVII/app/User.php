<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\KlasterPsikometrik;
use App\KategoriPsikometrik;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    // protected $connection = ''; tidak perlu dipakai, karena database pusatblk sudah diset sebagai database utama

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
       'email','nomor_identitas', 'jenis_identitas', 'nama_depan', 'nama_belakang','nomer_hp','kota', 'alamat',
       'username','password','ktp','pas_foto','ijazah','ksk', 'is_verified', 'verified_by', 'verified_at', 'roles_id', 'countries_id','tempat_lahir',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $primaryKey = 'email';
    //perlu ditambahkan agar primary key dapat dikenali
    public $incrementing = false;
    protected $keyType = 'string';

    public function role(){
        return $this->belongsTo('App\Role','roles_id');
    }
    
    public function ujiMinatAwals(){
        return $this->hasMany('App\UjiMinatAwal','users_email', 'email');
    }
    public static function hasilTerakhir($user){
        $dataKlaster=KlasterPsikometrik::where('id','!=',0)->get();
        $dataKategori=KategoriPsikometrik::where('id','!=',0)->get();
       
        $arr_hasil=[];
        $arr_akhir=[];
        $hasil_terakhir="";

        foreach($user as $u){
            //mencari sesi tes tahap 1 terbaru
            $sesi= DB::connection('uvii')->table('uji_minat_awals as um')
                    ->select('um.id', 'um.klaster_id')
                    ->where('um.users_email',$u->email)
                    ->orderBy('um.tanggal_selesai','DESC')
                    ->first();

            if($sesi){
                //mencari hasil kategori 
                $arr_kategori = [];
                
                foreach($dataKategori as $dKat){

                    $hasil= DB::connection('uvii')->table('hasil_rekomendasi_tes_tahap_2 as ht')
                        ->select('ht.kategori_id')
                        ->where('ht.uji_minat_awals_id',$sesi->id)
                        ->where('ht.kategori_id', $dKat->id)
                        ->first();

                    if($hasil){
                        array_push($arr_kategori, $dKat->nama);
     
                        $hasil_kategori = implode(', ',$arr_kategori);
                    }
                  
                }

                //mencari hasil klaster
                foreach($dataKlaster as $dk){
            
                    if($dk->id == $sesi->klaster_id){
                        $hasil_terakhir= $dk->nama;
                        break;
                    }
                }
                
            }  
            else{
                $hasil_terakhir= "Belum Tes";
                $hasil_kategori ="Belum Tes";
            }    
             
            $arr_hasil=['nama_depan'=>$u->nama_depan,'nama_belakang'=>$u->nama_belakang, 'email'=>$u->email, 'No.Hp'=>$u->nomer_hp, 'klaster'=>$hasil_terakhir ?? 'Belum tes', 'kategori'=>$hasil_kategori ?? 'Belum tes','kota'=>$u->kota, 'jenis_kelamin'=>$u->jenis_kelamin, 'alamat'=>$u->alamat,'jenis_identitas'=>$u->jenis_identitas, 'tempat_lahir'=>$u->tempat_lahir,'tanggal_lahir'=>$u->tanggal_lahir,'username'=>$u->username,'pendidikan'=>$u->pendidikan_terakhir,'konsentrasi'=>$u->konsentrasi_pendidikan];
            array_push($arr_akhir,$arr_hasil);

        }

        return $arr_akhir;
        
    }  


}
