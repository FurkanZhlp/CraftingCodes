<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "name","price","download","ownerid","image","desc","slug"
    ];
    public function owner()
    {
        return $this->hasOne('App\User','id','ownerid');
    }
    public function versions()
    {
        return $this->hasMany('App\ProductVersion','product_id','id')->orderByDesc('id');
    }
    public  function image()
    {
        return $this->image();
    }
}
