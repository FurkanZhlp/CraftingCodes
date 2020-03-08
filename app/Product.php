<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function owner()
    {
        return $this->hasOne('App\User','id','ownerid');
    }
}
