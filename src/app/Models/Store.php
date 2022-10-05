<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Consts\CustomConst;
use Storage;
class Store extends Model
{

    use Sortable;

    const STATUS_RELEASED = 1;
    const STATUS_PRIVATE = 2;


    protected $fillable = [
        'name',
        'tel',
        'address',
        'start_time',
        'end_time',
        'latitude',
        'longitude',
        'status',
        'mon_start_time',
        'mon_end_time',
        'tue_start_time',
        'tue_end_time',
        'wed_start_time',
        'wed_end_time',
        'thu_start_time',
        'thu_end_time',
        'fri_start_time',
        'fri_end_time',
        'sat_start_time',
        'sat_end_time',
        'sun_start_time',
        'sun_end_time',
        'hol_start_time',
        'hol_end_time',
        'cafe_flg',
        'wine_flg',
        'oven_flg',
        'description',
        'pic_path',
    ];

    public $sortable = [
        'id',
        'name',
        'tel',
        'address',
        'start_time',
        'end_time',
        'latitude',
        'longitude',
        'status',
        'mon_start_time',
        'mon_end_time',
        'tue_start_time',
        'tue_end_time',
        'wed_start_time',
        'wed_end_time',
        'thu_start_time',
        'thu_end_time',
        'fri_start_time',
        'fri_end_time',
        'sat_start_time',
        'sat_end_time',
        'sun_start_time',
        'sun_end_time',
        'hol_start_time',
        'hol_end_time',
        'cafe_flg',
        'wine_flg',
        'oven_flg',
        'description',
        'created_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */
    public function slides()
    {
        return $this->hasMany('App\Models\Slide', 'store_id');
    }



    public function setStatusClass()
    {
        switch ($this->status) {
            case self::STATUS_RELEASED:
                return 'status_release';
            case self::STATUS_PRIVATE:
                return 'status_private';
        }
    }


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
     * 公開中
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOpen($query)
    {
        return $query->where('status', 1);
    }


    /**
     * 一覧を取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIndex($query)
    {
        return $query->take(CustomConst::DISPLAYD_NUMBER);
    }

    /**
     * 更に読み込む
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMore($query, $length)
    {
        return $query->skip($length)->take(CustomConst::DISPLAYD_NUMBER);
    }
    /**
     * キーワード
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  String $keyword
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKeyword($query, $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            $query->whereRaw("stores.name LIKE '%$keyword%'");
        });
    }

    public function getCafeFlgLabel()
    {
        switch ($this->cafe_flg) {
            case null:
                return "無";
            case 1:
                return "有";
        }
    }
    public function getWineFlgLabel()
    {
        switch ($this->wine_flg) {
            case null:
                return "無";
            case 1:
                return "有";
        }
    }
    public function getOvenFlgLabel()
    {
        switch ($this->oven_flg) {
            case null:
                return "無";
            case 1:
                return "有";
        }
    }

    /**
     * S3画像表示
     *
     * @return String
     */
    public function getUrlAttribute()
    {
        $this->surl = asset('img/img_noimg.svg');
        if ($path = $this->pic_path) {
            $this->surl = Storage::disk('s3')->url($path);
        }
        return $this->surl;
    }

    public function isImage()
    {
        return isset($this->pic_path);
    }
}
