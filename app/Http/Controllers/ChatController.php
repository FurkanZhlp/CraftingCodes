<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Message;
use App\Conversation;
use Carbon\Carbon;

class ChatController extends Controller
{
    public function index($chatWith = null , Request $request)
    {
        if($request->isMethod('get')) {
            $data["conversations"] = Auth::user()->conversations();
            if ($chatWith) {
                if (Auth::user()->username == $chatWith) return redirect(route('chat'));
                $user = User::where('username', '=', $chatWith)->first();
                if (!$user) return redirect(route('chat'));
                $data["chatUser"] = $user;
                $chat = Conversation::bul($user->id, Auth::user()->id);
                if($chat) $chat->readMessages();
                $data["chat"] = $chat;
            }
            $data["conversations"] = Auth::user()->conversations();
            $agent = new Agent();
            if ($agent->isMobile()) {
                return view('user.chat_mobile');
            } else {
                return view('user.chat')->with($data);
            }
        }
        elseif($request->isMethod('post'))
        {
            if (Auth::user()->username == $chatWith) return json_encode(["status"=>false]);
            $user = User::where('username', '=', $chatWith)->first();
            if (!$user) return json_encode(["status"=>false]);
            $chat = Conversation::bul($user->id, Auth::user()->id);
            if(!$chat)
            {
                $chat = new Conversation;
                $chat->user_one = Auth::user()->id;
                $chat->user_two = $user->id;
                $chat->status = 1;
                $chat->save();
            }
            if (!$request->message) return json_encode(["status2"=>false]);
            $message = new Message;
            $message->message = $request->message;
            $message->user_id = Auth::user()->id;
            $message->conversation_id = $chat->id;
            $message->is_seen = 0;
            $message->save();
            $chat->touch();
            return json_encode(["status"=>true]);
        }
    }
}
