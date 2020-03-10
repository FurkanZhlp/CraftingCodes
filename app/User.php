<?php

namespace App;

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
    public function userImage()
    {
        if($this->image != null) return url('/storage/users/'.$this->id.'.png');
        return url('logo-sm.png');
    }
    public function username()
    {
        return '<a href="#">@'.$this->username.'</a>';
    }
}
