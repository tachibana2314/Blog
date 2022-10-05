<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserSearch extends Model
{
    protected $fillable = [
        'sort',
        'direction',
        'keyword',
        'nickname',
        'email',
        'birthday',
        // 'gender',
        'left_at',
    ];

    public function getQuery()
    {
        return new User;
    }

    public function getleftAtLabelAttribute()
    {
        if ($this->left_at == null) {
            return 'アクティブ';
        } else {
            return '退会済み';
        }
    }
}
