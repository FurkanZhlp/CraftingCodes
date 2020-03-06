<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Options;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public  function index()
    {
        $option=Options::first();
        return view("admin.anasayfa");
    }
    public function uye($id)
    {
        $user = \App\User::find($id);
        if(!$user)
        {
            return redirect(route('admin'));
            die;
        }
        $data["user"] = $user;
        return view("admin.uye")->with($data);
    }
    public function products()
    {
        return view('admin.urunler');
    }
    public function users()
    {
        $users = User::orderByDesc('id')->paginate(30);
        return view('admin.uyeler', ['users' => $users]);
    }
}
