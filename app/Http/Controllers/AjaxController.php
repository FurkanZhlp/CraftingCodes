<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function deleteUser(Request $request)
    {
        $input = $request->all();
        $userid = $input["id"];
        $user = \App\User::where('email', '=', $userid)->first();
        if ($user == null) return json_encode(["status" => false, "message" => "Kullanıcı bulunamadı"]);
        \App\User::find($user->id)->delete();
        return json_encode(["status"=>true,"message"=>"Üye Başarıyla Silindi"]);
    }
}
