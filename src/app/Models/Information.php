<?php

namespace App\Models;

use App\Consts\CustomConst;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Storage;

class Information extends Model
{
    use Sortable;
    protected $table = 'informations';

    protected $fillable = [
        'title',
        'body',
        'pic_path',
        'status',
        'release_date',
        'created_at',
        'updated_at',
        'push_flg',
        'product_id'
    ];

    public $sortable = [
        'id',
        'title',
        'body',
        'pic_path',
        'status',
        'release_date',
        'created_at',
        'updated_at',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */
    public function slides()
    {
        return $this->hasMany('App\Models\Slide', 'information_id');
    }

    public function reads()
    {
        return $this->hasMany('App\Models\Read');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    const STATUS_RELEASED = 1;
    const STATUS_PRIVATE = 2;

    /**
     * setStatusClass
     *
     * @return void
     */
    public function setStatusClass()
    {
        switch ($this->status) {
            case self::STATUS_RELEASED:
                return 'status_release';
            case self::STATUS_PRIVATE:
                return 'status_private';
        }
    }

    /**
     * setStatusLabel
     *
     * @return void
     */
    public function setStatusLabel()
    {
        switch ($this->status) {
            case self::STATUS_RELEASED:
                return '公開';
            case self::STATUS_PRIVATE:
                return '非公開';
        }
    }

    /**
     * S3画像表示
     *
     * @return String
     */
    public function getUrlAttribute()
    {
        $this->iurl = asset('img/img_noimg.svg');
        if ($path = $this->pic_path) {
            $this->iurl = Storage::disk('s3')->url($path);
        }
        return $this->iurl;
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * 公開中 && 公開日の降順でorderby
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->with('reads')
            ->where('status', 1)
            ->where('release_date', '<=', new Carbon());
    }

    /**
     * 一覧を取得 with 既読テーブル
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

    /**
     * 未読
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnread($query)
    {
        return $query->doesntHave('reads');
    }

    public function scopeWithRelations($query)
    {
        return $query->with([
            'product',
            'product.category',
            'product.pictures',
            'product.favorites',
        ]);
    }

}
