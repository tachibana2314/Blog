<?php

namespace App\Models;

use App\Models\Store;
use Illuminate\Database\Eloquent\Model;

class StoreSearch extends Model
{
    protected $fillable = [
        'sort',
        'direction',
        'keyword',
        'tel',
        'address',
        'cafe_flg',
        'wine_flg',
        'oven_flg',
        'latitude',
        'longitude',
        'description',
        'status',
    ];

    public function getQuery()
    {
        return new Store;
    }
}
