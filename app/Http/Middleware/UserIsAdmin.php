<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserIsAdmin
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
        if ($request->user()->role == "0")
        {
            return redirect('/panel');
            die(json_encode(["status"=>false,"message"=>"Yetkisiz Rol"]));
        }

        return $next($request);
    }
}
