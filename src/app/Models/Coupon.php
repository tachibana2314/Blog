<?php

namespace App\Models;

use App\Consts\CustomConst;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Storage;

class Coupon extends Model
{
    use Sortable;
    protected $table = 'coupons';

    protected $fillable = [
        'title',
        'product_id',
        'barcode',
        'description',
        'terms_of_use',
        'status',
        'type',
        'start_date',
        'end_date',
        'release_date',
        'target_month',
        'normal_limit_flg'
    ];

    protected $sortable = [
        'id',
        'title',
        'product_id',
        'barcode',
        'description',
        'terms_of_use',
        'status',
        'type',
        'start_date',
        'end_date',
        'release_date',
        'created_at',
        'target_month'
    ];


    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function slides()
    {
        return $this->hasMany('App\Models\Coupon', 'coupon_id');
    }

    public function couponHistories()
    {
        return $this->hasMany('App\Models\CouponHistory', 'coupon_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Constant（定数）
    |--------------------------------------------------------------------------
    */

    const STATUS_RELEASED = 1;
    const STATUS_PRIVATE = 2;
    const STATUS_DRUFT = 3;

    const TYPE_NEWS = 1;
    const TYPE_PRODUCT = 2;
    const TYPE_COUPON = 3;
    const TYPE_STORE = 4;

    /**
     * 利用可能回数
     */
    const AVAILABLE_TIMES = [
        null => '無制限（期間内）',
        1 => '1回'
    ];

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

    public function setTypeClass()
    {
        switch ($this->type) {
            case self::TYPE_NEWS:
                return 'type_news';
            case self::TYPE_PRODUCT:
                return 'type_product';
            case self::TYPE_COUPON:
                return 'type_coupon';
            case self::TYPE_STORE:
                return 'type_store';
        }
    }

    public function setTypeLabel()
    {
        switch ($this->type) {
            case 1:
                return "通常クーポン";
            case 2:
                return "誕生日クーポン";
        }
    }

    /**
     * S3画像表示
     *
     * @return String
     */
    public function getUrlAttribute()
    {
        $this->url = asset('img/img_noimg.svg');

        if ($this->barcode) {
            $this->url = Storage::disk('s3')->Url($this->barcode);
        }

        return $this->url;
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * 公開中
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->with(['product.pictures'])
            ->where('status', 1)
            ->where('release_date', '<=', new Carbon())
            ->latest('release_date');
    }

    /**
     * ノーマルクーポン（type = 1）
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNormal($query)
    {
        return $query->where('type', 1)
            ->where('start_date', '<=', now()->format('Y-m-d'))
            ->where('end_date', '>=', now()->format('Y-m-d'));
    }

    /**
     * バースデイクーポン（type = 2）
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  Int $target_month
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBirthday($query, $target_month)
    {
        return $query->where('type', 2)
            ->where('target_month', $target_month);
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

            // ->where(function ($query) {
            //     $query->where('start_date', '<=', new Carbon())
            //         ->where('end_date', '>=', new Carbon());
            // });
            // ->orWhere(function ($query) use ($target_month) {
            //     $query->where('target_month', $target_month);
            // });
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
     * @param  Int $length
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMore($query, $length)
    {
        return $query->skip($length)->take(CustomConst::ACQUISITIONS);
    }
}
