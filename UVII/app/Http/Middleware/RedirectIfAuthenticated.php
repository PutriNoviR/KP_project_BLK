<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::guard($guard)->check()) {
            if(!Auth::check()){
                return redirect(RouteServiceProvider::HOME); 
            }

            if(Auth::check() && $request){
                // dd($request);
                return redirect()->back();
            }
        }

        return $next($request);
    }
}
