<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Cache;
use Carbon\Carbon;

class UserActivity
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
        if(Auth::guard($guard)->check())
        {
            $expiresAt = Carbon::now()->addMinutes(2);
            Cache::put('user-online-'.Auth::user()->id,true,$expiresAt);
            $user = Auth::user();
            $user["last_seen"] = time();
            $user->save();
        }
        return $next($request);
    }
}
