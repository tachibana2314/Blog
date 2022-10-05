<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Storage;
use Carbon\Carbon;

class Slide extends Model
{
    protected $table = 'slides';

    protected $fillable = [
        'pic_path',
        'status',
        'start_date',
        'end_date',
        'order',
        'url',
        'type',
        'product_id',
        'store_id',
        'coupon_id',
        'information_id',
        'stamp_id',
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

    public function store()
    {
        return $this->belongsTo('App\Models\Store', 'store_id');
    }

    public function information()
    {
        return $this->belongsTo('App\Models\Information', 'information_id');
    }

    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon', 'coupon_id');
    }

    public function stamp()
    {
        return $this->belongsTo('App\Models\StampCard', 'stamp_id');
    }




    const STATUS_RELEASED = 1;
    const STATUS_PRIVATE = 2;

    const TYPE_NEWS = 1;
    const TYPE_PRODUCT = 2;
    const TYPE_COUPON = 3;
    const TYPE_STORE = 4;

    public function isPublic()
    {
        return $this->status == self::STATUS_RELEASED;
    }

    public function isPrivate()
    {
        return $this->status == self::STATUS_PRIVATE;
    }


    public function withinStartDate()
    {
        return $this->start_date <= now()->format('Y-m-d');
    }

    public function withinEndDate()
    {
        return $this->end_date >= now()->format('Y-m-d');
    }

    public function beyondStartDate()
    {
        return $this->start_date > now()->format('Y-m-d');
    }

    public function beyondEndDate()
    {
        return $this->end_date < now()->format('Y-m-d');
    }


    public function setStatusClass()
    {
        if ($this->isPublic() && $this->withinStartDate() && $this->withinEndDate()) {
            return 'status_release';
        }else if($this->isPublic() && $this->beyondStartDate()){
            return 'status_before';
        }else if($this->isPublic() && $this->beyondEndDate()){
            return 'status_released';
        }else{
            return 'status_druft';
        }
    }

    public function setStatusLabel()
    {
        if ($this->isPublic() && $this->withinStartDate() && $this->withinEndDate()) {
            return '公開';
        }else if($this->isPublic() && $this->beyondStartDate() && $this->beyondEndDate()){
            return '公開前';
        }else if($this->isPublic() && $this->beyondStartDate() && $this->beyondEndDate()){
            return '公開終了';
        }else{
            return '下書き';
        }
    }



    /**
     * 公開期間表示
     *
     * @return String
     */
    public function getDisplayPeriodAttribute()
    {
        return filled($this->start_date) ? $this->start_date."〜".$this->end_date: "未設定";
    }


    public function getOrderLabelAttribute()
    {
        return filled($this->order) ? $this->order: "未設定";
    }



    public function setTypeLabel()
    {
        switch ($this->type) {
            case 1:
                return 'お知らせ';
            case 2:
                return '商品';
            case 3:
                return 'クーポン';
            case 4:
                return '店舗';
            case 5:
                return '外部URL';
            case 6:
                return 'スタンプカード';
        }
    }

    /**
     * S3画像表示
     *
     * @return String
     */
    public function getSlideUrlAttribute()
    {
        $this->surl = asset('img/img_noimg.svg');

        if ($path = $this->pic_path) {

            $this->surl = Storage::disk('s3')->url($path);
        }

        return $this->surl;
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
        return $query->with([
            'coupon.product.pictures',
            'information.product.category',
            'information.product.pictures',
            'product.category',
            'product.pictures',
            'store',
            'stamp',
        ])->where('status', 1);
    }

    // 公開期間
    public function scopePublicPeriod($query)
    {
        return $query->with([
                'coupon.product.pictures',
                'information.product.category',
                'information.product.pictures',
                'product.category',
                'product.pictures',
                'store',
                'stamp',
            ])->where('status', 1)
            ->where('start_date', '<=', now()->format('Y-m-d'))
            ->where('end_date', '>=', now()->format('Y-m-d'));
    }

    // 公開
    public function scopePublic($query)
    {
        return $query->where('status', 1);
    }

     // 非公開
    public function scopePrivate($query)
    {
        return $query->where('status', 2);
    }

     // 表示順番
    public function scopeDisplayOrder($query)
    {
        return $query->orderBy('status', 'asc')
                    ->orderBy('order', 'asc')
                    ->orderBy('created_at', 'desc');
    }


}
