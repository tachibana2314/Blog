<?php

namespace App\Models;

use App\Models\Information;
use Illuminate\Database\Eloquent\Model;

class InformationSearch extends Model
{
    protected $fillable = [
        'sort',
        'direction',
        'keyword',
        'title',
        'body',
        'status',
        'release_date',
    ];

    public function getQuery()
    {
        return new Information;
    }
}
