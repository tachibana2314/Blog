<?php

namespace App\Models;

use App\Models\StampCoupon;
use Illuminate\Database\Eloquent\Model;

class StampCouponSearch extends Model
{
    protected $fillable = [
        'sort',
        'keyword',
        'title',
        'product_id',
        'barcode',
        'description',
        'status',
        'type',
        'start_date',
        'end_date',
    ];

    public function getQuery()
    {
        return new StampCoupon;
    }
}
