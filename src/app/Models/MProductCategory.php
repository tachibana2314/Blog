<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MProductCategory extends Model
{
    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}
