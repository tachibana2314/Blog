<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{

    protected $table = 'stamps';

    protected $fillable = [
        'user_id',
        'stamp_card_id',
        'created_at',
        'updated_at',
    ];

    public function scopeMyStamp($query, $uid)
    {
        return $query->whereHas('stamps', function ($query) use ($uid) {
            $query->where('user_id', $uid);
        });
    }
}
