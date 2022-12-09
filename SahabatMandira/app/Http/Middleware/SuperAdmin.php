<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd(Auth::user()->role->nama_role);
        if(Auth()->check())
        {
            if (Auth::user()->role->nama_role !== 'superadmin') {
                abort(403);
            }
        }
        else
        {
            return redirect('/login');
        }
        
        return $next($request);
    }
}
