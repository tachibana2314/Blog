<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMAllergy extends Model
{
    protected $table = 'product_m_allergies';

    protected $fillable = [
        'product_id',
        'm_allergy_id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */
    public function allergy()
    {
        return $this->belongsTo('App\Models\MAllergy', 'm_allergy_id');
    }

    public function product()
    {
        return $this->belongsToMany('App\Models\Product', 'product_id');
    }
}
