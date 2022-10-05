<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class PurchaseProduct extends Model
{
    protected $fillable = [
        'product_no',
        'name',
        'price',
        'tax',
        'quantity',
        'currency',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */
    public function purchase()
    {
        return $this->belongsTo('App\Models\Purchase');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_no', 'product_no');
    }
}
