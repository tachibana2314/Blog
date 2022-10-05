<?php

namespace App\Models;

use App\Consts\CustomConst;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;
use Storage;

class Purchase extends Model
{
    protected $fillable = [
        'purchase_no',
        'cashier_no',
        'staff_no',
        'purchase_timestamp',
        'sub_total',
        'tax',
        'total',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function purchase_products()
    {
        return $this->hasMany('App\Models\PurchaseProduct');
    }

    public function points()
    {
        return $this->hasMany('App\Models\Point');
    }

    /*
    |--------------------------------------------------------------------------
    | Scope
    |--------------------------------------------------------------------------
    */

    /**
     * 一覧を取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIndex($query)
    {
        return $query->take(CustomConst::ACQUISITIONS);
    }

    /**
     * 更に読み込む
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMore($query, $length)
    {
        return $query->skip($length)->take(CustomConst::ACQUISITIONS);
    }

    /*
    |--------------------------------------------------------------------------
    | Custom Methods
    |--------------------------------------------------------------------------
    */

    /**
     * 取得ポイント
     *
     * @return Integer
     */
    public function getPointAttribute()
    {
        $point = 0;

        foreach ($this->points()->acquire()->get() as $_point) {
            $point += $_point->amount;
        }

        return $point;
    }
}
