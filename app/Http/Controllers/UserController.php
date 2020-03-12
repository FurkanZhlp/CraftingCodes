<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function index($username = null,Request $request,$guard = null)
    {
        if(!$username || (Auth::guard($guard)->check() && (Auth::user()->username == $username)))
        {
            $user = Auth::user();
            $data["ownProfile"] = true;
        }
        else
        {
            $user = User::where('username','=',$username)->first();
            $data["ownProfile"] = false;
            if(!$user) return redirect(route('home'));
        }
        if(Cookie::get('lastprofile') != $user->username)
        {
            Cookie::unqueue('lastprofile');
            Cookie::queue('lastprofile',$user->username, 120);
            $user->profile_view += 1;
            $user->save();
        }
        $data["user"] = $user;
        return view('user.profile')->with($data);
    }
}
