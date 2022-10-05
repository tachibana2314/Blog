<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Point;

class PointSearch extends Model
{
    protected $fillable = [
        'sort',
        'direction',
        'keyword',
        'type',
        'order',
    ];

    public function getQuery()
    {
        return new Point;
    }
}
