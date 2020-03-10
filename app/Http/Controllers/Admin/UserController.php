<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('id')->paginate(15);
        return view('admin.uyeler', ['users' => $users]);
    }
    public function edit($id ,Request $request)
    {
        $user = \App\User::find($id);
        if(!$user)
        {
            return redirect(route('admin'));
            die;
        }
        if($request->isMethod('get'))
        {
            $data["user"] = $user;
            return view("admin.uye")->with($data);
        }
        elseif($request->isMethod('put'))
        {
            $data = $request->all();
            $image = $data["image"];
            $image_array_1 = explode(";", $image);
            $image_array_2 = explode(",", $image_array_1[1]);
            $image = base64_decode($image_array_2[1]);
            $file_name = $id.".png";
            Storage::put('public/users/'.$file_name, $image);
            $user->image = 1;
            $user->save();
            return json_encode(['status'=>true]);
        }
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
            'name' => ['required', 'string', 'max:255','min:2'],
            'username' => ['required','string','max:12','min:3','regex:/^([a-zA-Z0-9]+)$/','unique:users'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
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
