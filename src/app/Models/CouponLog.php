<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponLog extends Model
{
    protected $table = 'coupon_logs';
    protected $fillable = [
        'user_id',
        'coupon_id',
        'start_date',
        'end_date',
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
}
