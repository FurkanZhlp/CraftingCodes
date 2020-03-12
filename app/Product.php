<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "name","price","download","ownerid","image","desc","slug","categoryid"
    ];
    public function owner()
    {
        return $this->hasOne('App\User','id','ownerid');
    }
    public function category()
    {
        return $this->hasOne('App\ProductCategory','id','categoryid');
    }
    public function versions()
    {
        return $this->hasMany('App\ProductVersion','product_id','id')->orderByDesc('id');
    }
    public  function image()
    {
        return url('/storage/products/'.$this->image);
    }
    public function statusFormat($formatted = false)
    {
        $status["value"] = ["Onay Bekliyor","Satışta","Satışa Kapalı"];
        $status["formattedValue"] = [
            '<span class="text-warning">Onay Bekliyor</span>',
            '<span class="text-success">Satışta</span>',
            '<span class="text-danger">Satışa Kapalı</span>'
        ];
        return ($formatted) ? $status["formattedValue"][$this->status] : $status["value"][$this->status];
    }
}
