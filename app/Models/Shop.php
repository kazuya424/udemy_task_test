<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function area()
    {
        //従（子）
        return $this->belongsTo('App\Models\Area');
    }

    public function routes()
    {
        return $this->belongsToMany('App\Models\Route');
    }
}
