<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\ProductVersion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::where('ownerid','=',Auth::user()->id)->orderByDesc('id')->paginate(15);
        return view('admin.urunler', ['products' => $products]);
    }
    public function versions($slug,Request $request)
    {
        $product = Product::where('slug', '=', $slug)->where('ownerid','=',Auth::user()->id)->first();
        if($request->isMethod('GET')) {
            if (!$product) {
                return redirect(route('admin.products'));
                die;
            }
            $data["product"] = $product;
            return view('admin.urun_dosya')->with($data);
        }
        elseif($request->isMethod('POST'))
        {
            if (!$product) return json_encode(['status'=>true]);
            $messages = [
                'required' => "Bu alan gereklidir.",
                'max' => "Bu alan maksimum :max karakter olmalıdır.",
                'min' => "Bu alan minimum :min karakter olmalıdır.",
                'unique' => "Böyle bir sürüm zaten bulunmakta.",
                'email' => "Email adresi geçersiz.",
                'file' => "Bu bir dosya türü olmalıdır",
                'mimes' => "Dosya biçimi rar olmalıdır",
            ];
            $validator = Validator::make($request->all(), [
                "version" => [
                    "required",
                    Rule::unique('product_versions')->where(function ($query) use($product,$request) {
                        return $query->where('product_id', $product->id)
                            ->where('version', $request->version);
                    })
                ],
                "file" => "required|file|mimes:rar"
            ],$messages);
            if($validator->passes())
            {
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $save["file"] = str_slug($product->name.'-'.$request->version,'_').'.'.$extension;
                $file->storeAs('public/versions',$save["file"]);
                $save["version"] = $request->version;
                $save["status"] = 1;
                $save["size"] = $file->getSize();
                $save["product_id"] = $product->id;
                ProductVersion::create($save);
                return json_encode(['status'=>true]);
            }
            return json_encode(['errors'=>$validator->errors()]);
        }
    }
    public function new(Request $request)
    {
        if ($request->isMethod('post')) {
            $messages = [
                'required' => "Bu alan gereklidir.",
                'max' => "Bu alan maksimum :max karakter olmalıdır.",
                'min' => "Bu alan minimum :min karakter olmalıdır.",
                'unique' => "Böyle bir ürün zaten bulunmakta.",
                'email' => "Email adresi geçersiz.",
                'file' => "Bu bir dosya türü olmalıdır",
                'mimes' => "Dosya biçimi :mimes olmalıdır",
                'image' => "Bu bir resim dosyası olmalıdır",
                'dimensions' => "Resim boyutu 240x240 olmalıdır"
            ];
            $validator = Validator::make($request->all(), [
                "name" => "required|min:3",
                "price" => "required|numeric|min:3",
                "desc" => "required|min:50",
                "image" => "required|image|dimensions:max_width=240,max_height=240,min_width=240,min_height=240"

            ],$messages);
            if($validator->passes())
            {
                $save["name"]       = $request->name;
                $save["price"]      = $request->price;
                $save["download"]   = 0;
                $save["ownerid"]    = auth()->user()->id;

                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $save["image"] = str_slug($request->name).'.'.$extension;
                $file->storeAs('public/products',$save["image"]);

                $save["desc"]       = $request->desc;
                $save["slug"]       = str_slug($request->name).time();
                Product::create($save);
                return json_encode(['status'=>true,'slug'=>$save["slug"]]);
            }
            return json_encode(['errors'=>$validator->errors()]);
        }
        elseif($request->isMethod('get'))
        {
            return view('admin.urun_ekle');
        }
    }
    public function edit($slug,Request $request)
    {
        if($request->isMethod('get'))
        {
            $product = Product::where('slug', '=', $slug)->where('ownerid','=',Auth::user()->id)->first();
            if($product == null) return redirect(route('admin.products'));
            $data["product"] = $product;
            return view('admin.urun_duzenle')->with($data);
        }
        elseif($request->isMethod('post'))
        {

            $messages = [
                'required' => "Bu alan gereklidir.",
                'max' => "Bu alan maksimum :max karakter olmalıdır.",
                'min' => "Bu alan minimum :min karakter olmalıdır.",
                'unique' => "Böyle bir ürün zaten bulunmakta.",
                'email' => "Email adresi geçersiz.",
                'file' => "Bu bir dosya türü olmalıdır",
                'mimes' => "Dosya biçimi :mimes olmalıdır",
                'image' => "Bu bir resim dosyası olmalıdır",
                'dimensions' => "Resim boyutu 240x240 olmalıdır"
            ];
            $validator = Validator::make($request->all(), [
                "name" => "required|min:3|unique:products",
                "price" => "required|numeric|min:3",
                "desc" => "required|min:50",
                "image" => "required|image|dimensions:max_width=240,max_height=240,min_width=240,min_height=240"

            ],$messages);
            if($validator->passes())
            {

            }
            return json_encode(['errors'=>$validator->errors()]);

        }
    }
}
