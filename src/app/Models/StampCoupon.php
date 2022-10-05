<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use DB;
use Kyslik\ColumnSortable\Sortable;
use App\Models\CouponLog;

class StampCoupon extends Model
{
    protected $table = 'stamp_coupons';
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title',
        'path_main',
        'path_sub',
        'description',
        'barcode',
        'stamp_count',
        'card_id',
        'status',
        'use_period',
    ];

    public $sortable = [
        'id',
        'title',
        'description',
        'stamp_count',
        'card_id',
        'status',
        'use_period',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */
    public function stampCard()
    {
        return $this->belongsTo('App\Models\StampCard', 'card_id');
    }

    public function couponHistories()
    {
        return $this->hasMany('App\Models\CouponHistory', 'stamp_coupon_id');
    }

    public function couponLog()
    {
        return $this->hasMany('App\Models\CouponLog', 'coupon_id');
    }

    const STATUS_RELEASED = 1;
    const STATUS_PRIVATE = 2;
    const STATUS_DRUFT = 3;

    public function setStatusClass()
    {
        switch ($this->status) {
            case self::STATUS_RELEASED:
                return 'status_release';
            case self::STATUS_PRIVATE:
                return 'status_private';
            case self::STATUS_DRUFT:
                return 'status_druft';
        }
    }

    public function setStatusLabel()
    {
        switch ($this->status) {
            case self::STATUS_RELEASED:
                return '公開';
            case self::STATUS_PRIVATE:
                return '非公開';
            case self::STATUS_DRUFT:
                return '下書き';
        }
    }

    public function scopeGetcoupon($query, $uid)
    {
        $date = Carbon::now();
        return
            $query->whereHas('couponLog', function ($query) use ($uid,$date) {
                $query->where('user_id', $uid)
                    // 使用期限日内
                    ->where('end_date', '>=', $date->subDay());
            });
    }

    public function scopeNocoupon($query, $uid)
    {
        return
            $query->whereDoesntHave('couponLog', function ($query) use ($uid) {
                $query->whereIn('user_id', [$uid]);
            });
    }


    public function scopePiriod($query, $userId)
    {
        $subCoupon = CouponLog::query()
            ->select(
                'coupon_id as target_id',
                DB::raw('MAX(end_date) as target_date')
            )
            ->where('user_id', $userId)
            ->groupBy('coupon_id');

        return $query->leftJoinSub($subCoupon, 'coupen_log', function ($join) {
            $join->on('stamp_coupons.id', '=', 'coupen_log.target_id');
        });
    }

    // 公開中
    public function scopePublished($query,$card_id)
    {
        return $query->where('status', 1)
            ->where('card_id', $card_id)
            ->with(['couponLog']);
    }
    
    // クーポン公開中
    public function scopePublish($query)
    {
        return $query->where('status', 1);
    }


    public function scopeIndex($query)
    {
        return $query->limit(5);
    }

    /**
     * 更に読み込む
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMore($query, $length)
    {
        return $query->skip($length)->limit(5);
    }


    /**
     * 使用済みクーポン（対象期間内 & 対象の誕生月）
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  Int $uid
     * @param  Int $target_month
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUsed($query, $uid)
    {
        return
            $query->whereHas('couponHistories', function ($query) use ($uid) {
                $query->where('user_id', $uid);
            });
    }

    /**
     * 未使用クーポン
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  Int $uid
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnused($query, $uid)
    {
        return
            $query->whereDoesntHave('couponHistories', function ($query) use ($uid) {
                $query->whereIn('user_id', [$uid]);
            });
    }
}
