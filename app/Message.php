<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Message extends Model
{
    //
    protected $fillable = [
        'message','is_seen','user_id','conversation_id'
    ];
    public function isRead()
    {
        return ($this->is_seen == 0 && $this->user_id != Auth::user()->id) ? true : false;
    }
    public static function unreadedConversations()
    {
        $conversations = Auth::user()->conversationsList();
        return Message::groupBy('conversation_id')->whereIn('conversation_id', $conversations)->where('user_id', '!=', Auth::user()->id)->where('is_seen', '=', 0)->get();
    }
}
