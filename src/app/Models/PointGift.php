<?php

namespace App\Models;

use App\Consts\CustomConst;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PointGift extends Model
{
    use Sortable;

    protected $fillable = [
        'name',
        'description',
        'point',
        'status',
        'order',
    ];

    public $sortable = [
        'id',
        'name',
        'description',
        'point',
        'status',
        'order',
        'created_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */
    public function point_gift_pictures()
    {
        return $this->hasMany('App\Models\PointGiftPicture');
    }

    public function getImageLabel()
    {
        return $this->point_gift_pictures->first();
    }

    public function points()
    {
        return $this->hasMany('App\Models\Point');
    }

    /*
    |--------------------------------------------------------------------------
    | Constant（定数）
    |--------------------------------------------------------------------------
    */

    /**
     * ステータス
     */
    const STATUS_RELEASED = 1;
    const STATUS_PRIVATE = 2;
    const STATUS_LIST = [
        self::STATUS_RELEASED => "公開",
        self::STATUS_PRIVATE => "非公開",
    ];

    public function setStatusClass()
    {
        switch ($this->status) {
            case self::STATUS_RELEASED:
                return 'status_release';
            case self::STATUS_PRIVATE:
                return 'status_private';
        }
    }

    public function getStatusLabel()
    {
        switch ($this->status) {
            case 1:
                return "公開";
            case 2:
                return "非公開";
        }
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
    public function scopeOpen($query)
    {
        return $query->where('point_gifts.status', 1);
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
            $query->whereRaw("point_gifts.name LIKE '%$keyword%'");
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
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMore($query, $length)
    {
        return $query->skip($length)->take(CustomConst::ACQUISITIONS);
    }

    /**
     * orderの昇順で表示
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrder($query)
    {
        return $query->orderBy('point_gifts.order', 'asc');
    }
}
