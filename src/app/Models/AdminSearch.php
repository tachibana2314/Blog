<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class AdminSearch extends Model
{
    protected $fillable = [
        'sort',
        'email',
        'keyword',
        'first_name',
        'last_name',
        'first_name_kana',
        'last_name_kana',
        'department',
        'position',
    ];

    public function getQuery()
    {
        return new Admin;
    }
}
