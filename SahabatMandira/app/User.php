<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'email','nomor_identitas', 'jenis_identitas', 'nama_depan', 'nama_belakang','nomer_hp','kota', 'alamat',
       'username','password','ktp','pas_foto','ijazah','ksk', 'is_verified', 'verified_by', 'verified_at', 'roles_id', 'countries_id',
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

    public function Perusahaan(){
        return $this->belongsTo('App\Perusahaan','verified_by');
    }
    
    public function blk()
    {
        return $this->belongsTo('App\Blk','blks_id_admin','id');
    }

    public function sesi_pelatihan()
    {
        return $this->belongsToMany('App\SesiPelatihan','mandira_db.pelatihan_mentors');
    }

    public function sesi_pelatihan_mentor()
    {
        return $this->setConnection('mysql')->belongsToMany('App\SesiPelatihan','mandira_db.pelatihan_mentors','mentors_email','sesi_pelatihans_id');
    }

    public function hasRole($roleName)
    {
        return $this->roles_id ==$roleName;
    }
}
