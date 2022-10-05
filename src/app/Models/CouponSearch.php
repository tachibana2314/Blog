<?php

namespace App\Models;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Model;

class CouponSearch extends Model
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
        'release_date',
    ];

    public function getQuery()
    {
        return new Coupon;
    }
}
