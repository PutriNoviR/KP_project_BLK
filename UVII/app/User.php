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
        foreach($user as $u){
            $hasil= DB::connection('uvii')->table('uji_minat_awals as um')
                ->select('um.klaster_id','ht.kategori_id')
                ->join('hasil_rekomendasi_tes_tahap_2 as ht','um.id','=','ht.uji_minat_awals_id')
                ->where('um.users_email',$u->email)
                ->orderBy('um.tanggal_selesai','DESC')
                ->first();
            
                if($hasil){
                foreach($dataKlaster as $dk){
                    if($dk->id == $hasil->klaster_id){
                        $hasil_terakhir= $dk->nama;
                    }

                }
                foreach($dataKategori as $dKat){
                    if($dKat->id ==$hasil->kategori_id){
                        $hasil_kategori =$dKat->kode;
                    }
                }
                
                }
                else{
                    $hasil_terakhir= "Belum Tes";
                    $hasil_kategori ="Belum Tes";
                }
                $arr_hasil=['nama_depan'=>$u->nama_depan,'nama_belakang'=>$u->nama_belakang, 'email'=>$u->email, 'No.Hp'=>$u->nomer_hp, 'klaster'=>$hasil_terakhir, 'kategori'=>$hasil_kategori,'kota'=>$u->kota, 'jenis_kelamin'=>$u->jenis_kelamin, 'alamat'=>$u->alamat,'jenis_identitas'=>$u->jenis_identitas, 'tempat_lahir'=>$u->tempat_lahir,'tanggal_lahir'=>$u->tanggal_lahir,'username'=>$u->username,'pendidikan'=>$u->pendidikan_terakhir,'konsentrasi'=>$u->konsentrasi_pendidikan];
                array_push($arr_akhir,$arr_hasil);

            


        }
        return $arr_akhir;
        
    }  


}
