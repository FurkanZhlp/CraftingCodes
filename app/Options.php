<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    //

    protected $table = "options";
    static public function value($name)
    {
        $value = Options::first()->$name;
        return $value;
    }
}
