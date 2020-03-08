<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('id')->paginate(15);
        return view('admin.uyeler', ['users' => $users]);
    }
    public function edit($id)
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
    public function new(Request $request)
    {
        $messages = [
            'required' => "Bu alan gereklidir.",
            'max' => "Bu alan maksimum :max karakter olmalıdır.",
            'min' => "Bu alan minimum :min karakter olmalıdır.",
            'unique' => "Bu mail daha önceden alınmış.",
            'email' => "Email adresi geçersiz.",
        ];
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:24|min:2",
            "email" => "required|string|email|max:50|unique:users",
            "password" => "required|string|max:255|min:6"
        ],$messages);
        if ($validator->passes())
        {
            $save = $request->all();
            $save["password"] = Hash::make($request->password);
            User::create($save);
            return json_encode(['status'=>true]);
        }
        return json_encode(['errors'=>$validator->errors()]);
    }
    public function delete(Request $request)
    {
        return json_encode(["status" => false, "message" => "Üye silme sistemi deaktif"]);
        $input = $request->all();
        if(!$input) return json_encode(["status" => false, "message" => "Kullanıcı bulunamadı"]);
        $userid = $input["id"];
        $user = \App\User::where('id', '=', $userid)->first();
        if ($user == null) return json_encode(["status" => false, "message" => "Kullanıcı bulunamadı"]);
        \App\User::find($user->id)->delete();
        return json_encode(["status"=>true,"message"=>"Üye Başarıyla Silindi"]);
    }
}
