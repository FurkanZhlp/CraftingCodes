<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::orderByDesc('id')->paginate(15);
        return view('admin.urunler', ['products' => $products]);
    }
    public function new(Request $request)
    {
        if ($request->isMethod('post')) {

        }
        elseif($request->isMethod('get'))
        {
            return view('admin.urun_ekle');
        }

    }
}
