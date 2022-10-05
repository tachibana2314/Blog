<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MAllergy extends Model
{
    protected $table = 'm_allergies';

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */

    public function allergies()
    {
        return $this->hasMany('App\Models\ProductMAllergy', 'm_allergy_id');
    }
}
