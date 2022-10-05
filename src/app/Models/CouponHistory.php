<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponHistory extends Model
{
    protected $fillable = [
        'user_id',
        'coupon_id',
        'stamp_coupon_id',
        'created_at',
        'updated_at',
    ];
    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon', 'coupon_id');
    }

    public function stamp_coupon()
    {
        return $this->belongsTo('App\Models\StampCoupon', 'stamp_coupon_id');
    }
}
