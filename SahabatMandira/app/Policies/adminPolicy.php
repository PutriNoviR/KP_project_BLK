<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function access(User $user){
        return ($user->peran == "Admin" ? Response::allow() : Response::deny("You must be a super administrator")); 
    }
    public function peserta(User $user)
    {
        return ($user->role->nama_role == 'peserta' ? Response::allow(): Response::deny('You must be a super administrator'));
    }
    public function superadmin(User $user)
    {
        return ($user->role->nama_role === 'superadmin' ? Response::allow() : Response::deny('You must be a super administrator'));
    }

    public function adminblk(User $user)
    {
        return ($user->role->nama_role === 'adminblk' || $user->role->nama_role === 'superadmin' ? Response::allow() : Response::deny('You must be an Admin BLK'));
    }
}
