<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserIsSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(!Auth::guard($guard)->check()) return redirect('/');
        if(Auth::user()->role != "1" && Auth::user()->admin == "0")
        {
            return redirect('/');
            die(json_encode(["status"=>false,"message"=>"Yetkisiz Rol"]));
        }

        return $next($request);
    }
}
