<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Message;

class Conversation extends Model
{
    //
    protected $fillable = [
        'user_one','user_two','status'
    ];
    public function chatWith()
    {
        return ($this->user_one != Auth::user()->id) ? $this->belongsTo('App\User','user_one','id') : $this->belongsTo('App\User','user_two','id');
    }
    public function lastMessage()
    {
        return $this->hasOne('App\Message','conversation_id','id')->orderBy('id','desc');
    }
    public function messages()
    {
        return $this->hasMany('App\Message','conversation_id','id')->orderBy('id')->orderBy('id','asc');
    }
    public function createIfNotExist($one,$two)
    {
        Conversation::where('user_one','=',$one)->orWhere('user_two','=',$two)->get();
        Conversation::where('user_one','=',$two)->orWhere('user_two','=',$one)->get();
    }
    public function readMessages()
    {
        return $this->hasMany('App\Message','conversation_id','id')->where('user_id','!=',Auth::user()->id)->update(["is_seen"=>1]);
    }
    public static function bul($user1, $user2)
    {
        $conversation = Conversation::where(
            function ($query) use ($user1, $user2) {
                $query->where(
                    function ($q) use ($user1, $user2) {
                        $q->where('user_one', $user1)
                            ->where('user_two', $user2);
                    }
                )
                    ->orWhere(
                        function ($q) use ($user1, $user2) {
                            $q->where('user_one', $user2)
                                ->where('user_two', $user1);
                        }
                    );
            }
        );

        if ($conversation->exists()) {
            return $conversation->first();
        }
    }
}
