<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Message;
use App\Conversation;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','admin','image','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','image'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isOnline()
    {
        if($this->last_seen >= time()-120) return true;
        return false;
    }
    public function lastSeen()
    {
        $time = $this->last_seen;
        if($time==0) return "Bilinmiyor";
        $periods = array("saniye", "dakika", "saat", "gün", "hafta", "ay", "yıl", "decade");
        $lengths = array("60","60","24","7","4.35","12","10");

        $now = time();

        $difference     = $now - $time;
        if($difference < 120) return "Çevrimiçi";
        $tense         = "ago";

        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);


        return "$difference $periods[$j] önce";
    }
    public function roleFormat()
    {
        $role = ["Üye","Satıcı"];
        return $role[$this->role];
    }
    public function adminFormat()
    {
        $role = ["Üye","Admin"];
        return $role[$this->admin];
    }
    public function showName()
    {
        $name = $this->name;
        $names = explode(" ",$name);
        $show = "";
        foreach ($names as $n)
        {
            $n = str_replace(" ","",$n);
            $show .= substr($n,0,2)." ";
        }
        return $show;
    }
    public function profile()
    {
        return route('profile',$this->username);
    }
    public function userImage()
    {
        if($this->image != null) return url('/storage/users/'.$this->id.'.png');
        return url('logo-sm.png');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'ownerid', 'id')->orderBy('id');
    }
    public function username()
    {
        return '<a href="#">@'.$this->username.'</a>';
    }
    public function ticaretPuani()
    {
        return 0;
    }
    public function conversations()
    {
        return Conversation::where('user_one','=',$this->id)->orWhere('user_two','=',$this->id)->orderBy('updated_at','desc')->get();
        /*$c = Message::select(DB::raw('LEAST(user_id, recipient_to) as user_id,GREATEST(user_id, recipient_to) AS recipient_to,MAX(id) AS max_id,users.*'))
            ->where('user_id','=',$this->id)
            ->join('users')
            ->orWhere('recipient_to','=',$this->id)->groupBy(DB::raw('LEAST(user_id, recipient_to),
							GREATEST(user_id, recipient_to)'))->get();
        return $c;*/
    }
    public function conversationsList()
    {
        return Conversation::select('id')->where('user_one','=',$this->id)->orWhere('user_two','=',$this->id)->get()->toArray();
        /*$c = Message::select(DB::raw('LEAST(user_id, recipient_to) as user_id,GREATEST(user_id, recipient_to) AS recipient_to,MAX(id) AS max_id,users.*'))
            ->where('user_id','=',$this->id)
            ->join('users')
            ->orWhere('recipient_to','=',$this->id)->groupBy(DB::raw('LEAST(user_id, recipient_to),
							GREATEST(user_id, recipient_to)'))->get();
        return $c;*/
    }
}
