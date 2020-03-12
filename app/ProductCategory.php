<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{

    protected $fillable = [
        'name', 'slug', 'status','parent_id','priority','color'
    ];
    public function childs()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id')->orderBy('priority');
    }
}
