<?php

namespace App\Http\Controllers\admin;

use App\ProductCategory;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request->isMethod('get'))
        {
            $categories = ProductCategory::where('parent_id','=',0)->orderBy('priority')->get();
            return view('admin.kategoriler', ['categories' => $categories]);
        }
        elseif($request->isMethod('post'))
        {
            $messages = [
                'required' => "Bu alan gereklidir.",
                'max' => "Bu alan maksimum :max karakter olmalıdır.",
                'min' => "Bu alan minimum :min karakter olmalıdır.",
                'unique' => "Bu mail daha önceden alınmış.",
                'email' => "Email adresi geçersiz.",
                'numeric' => "Bu alan sayı olmalıdır"
            ];
            $validator = Validator::make($request->all(),[
                'name' => "required",
                'color' => "required",
                'priority' => 'required|numeric'
            ],$messages);
            if($validator->passes())
            {
                $save["color"] = $request->color;
                $save["name"] = $request->name;
                $save["priority"] = $request->priority;
                $save["slug"] = str_slug($request->name).'.'.time();
                $save["parent_id"] = $request->parent_id;
                if($request->parentid > 0)
                {
                    $parent = ProductCategory::where('id','=',$request->parent_id);
                    if(!$parent) return json_encode(["status"=>true]);
                    if($parent->parent_id != 0) return json_encode(["status"=>true]);
                }
                ProductCategory::create($save);
                return json_encode(["status"=>true]);
            }
            return json_encode(['errors'=>$validator->errors()]);
        }
    }
}
