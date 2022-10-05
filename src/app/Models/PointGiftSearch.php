<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PointGift;

class PointGiftSearch extends Model
{
    protected $fillable = [
        'sort',
        'direction',
        'keyword',
        'name',
        'point',
        'status',
        'order',
    ];

    public function getQuery()
    {
        return new PointGift;
    }
}
