<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Options;

class AdminController extends Controller
{
    public  function index()
    {
        $option=Options::first();
        return view("admin.anasayfa");
    }
    public function products()
    {
        $products = \App\Product::orderByDesc('id')->paginate(30);
        return view('admin.urunler', ['products' => $products]);
    }
}
