<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function index()
    {
        $products = Product::where('status','!=','0')->orderByDesc('id')->take(4)->get();
        return view('home', ['products' => $products]);
    }
}
