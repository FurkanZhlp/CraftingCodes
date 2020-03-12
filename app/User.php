<?php

namespace App;

use Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        return Cache::has('user-online-'.$this->id);
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
}
