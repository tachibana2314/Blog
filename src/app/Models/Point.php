<?php

namespace App\Models;

use App\Consts\CustomConst;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Point extends Model
{
    protected $fillable = [];

    const TYPE_ACQUIRE = 1;
    const TYPE_USE = 2;
    const TYPE_LIST = [
        self::TYPE_ACQUIRE => '付与',
        self::TYPE_USE => '交換',
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

    public function purchase()
    {
        return $this->belongsTo('App\Models\Purchase');
    }

    public function point_gift()
    {
        return $this->belongsTo('App\Models\PointGift');
    }

    /*
    |--------------------------------------------------------------------------
    | Scope
    |--------------------------------------------------------------------------
    */
    public function scopeAcquire($query)
    {
        return $query->where('type', self::TYPE_ACQUIRE);
    }

    public function scopeUse($query)
    {
        return $query->where('type', self::TYPE_USE);
    }

    public function scopeValid($query)
    {
        return $query->where('points.expired_at', '>', date('Y-m-d H:i:s'));
    }

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
    | Custom Method
    |--------------------------------------------------------------------------
    */
    public function getTypeLabelAttribute()
    {
        return $this->type ? data_get(self::TYPE_LIST, $this->type) : null;
    }
}
