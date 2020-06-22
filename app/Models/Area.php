<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function shops()
    {
        //主（親）
        return $this->hasMany('App\Models\Shop');
    }
}
