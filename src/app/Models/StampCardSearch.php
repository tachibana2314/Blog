<?php

namespace App\Models;

use App\Models\StampCard;
use Illuminate\Database\Eloquent\Model;

class StampCardSearch extends Model
{
    protected $fillable = [
        'sort',
        'keyword_card',
        'title',
        'description',
        'card_status',
    ];

    public function getQuery()
    {
        return new StampCard;
    }
}
