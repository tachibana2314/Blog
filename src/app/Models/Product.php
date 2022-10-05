<?php

namespace App\Models;

use App\Consts\CustomConst;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'm_product_category_id',
        'price',
        'description',
        'calory',
        'status',
        'order',
        'online_flg',
        'limited_flg',
        'recommend_flg',
        'release_date',
        'start_date',
        'end_date',
    ];

    public $sortable = [
        'id',
        'name',
        'm_product_category_id',
        'price',
        'description',
        'calory',
        'status',
        'order',
        'online_flg',
        'limited_flg',
        'start_date',
        'end_date',
        'favorites_count',
        'created_at'
    ];

    public function favoritesCountSortable($query, $direction)
    {
        return $query->orderBy('favorites_count', $direction);
    }

    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */
    public function pictures()
    {
        return $this->hasMany('App\Models\Picture');
    }

    public function allergies()
    {
        return $this->hasMany('App\Models\ProductMAllergy');
    }

    public function mAllergies()
    {
        return $this->belongsToMany('App\Models\ProductMAllergy', 'product_m_allergies', 'product_id', 'm_allergy_id')->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo('App\Models\MProductCategory', 'm_product_category_id');
    }

    public function coupons()
    {
        return $this->hasMany('App\Models\Coupon', 'product_id');
    }

    public function slides()
    {
        return $this->hasMany('App\Models\Slide', 'product_id');
    }

    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
    }


    public function getImageLabel()
    {
        return $this->pictures->first();
    }

    public function getfavoriteCountLabel()
    {
        return $this->favorites->count();
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

    /**
     * お勧めフラグ（１.お勧め）
     */
    const RECOMMENDED = 1;
    const NOT_RECOMMENDED = null;

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

    public function getStatusLabel()
    {
        switch ($this->status) {
            case 1:
                return "公開";
            case 2:
                return "非公開";
        }
    }

    public function getOnlineFlgLabel()
    {
        switch ($this->online_flg) {
            case null:
                return "非対応";
            case 1:
                return "対応";
        }
    }

    public function getLimitedFlgLabel()
    {
        switch ($this->limited_flg) {
            case null:
                return "";
            case 1:
                return "期間限定商品";
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    */

    /**
     * お勧めフラグ
     *
     * @return String
     */
    public function getRecommendationAttribute()
    {
        switch ($this->recommend_flg) {
            case self::RECOMMENDED:
                return '設定済';
            case self::NOT_RECOMMENDED:
                return '未設定';
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
        return $query->where('status', 1);
    }

    /**
     * with category, pictures, favorites
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithRelations($query)
    {
        return $query->with([
            'category',
            'pictures',
            'favorites'
        ]);
    }

    /**
     * 期限内
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLimited($query)
    {
        return
            $query->where(function ($query) {
                $query->whereNull('limited_flg')
                    ->orWhere(function ($query) {
                        $query->where('limited_flg', 1)
                            ->where('release_date', '<=', new Carbon())
                            ->where('end_date', '>=', new Carbon());
                    });
            });
    }

    /**
     * カテゴリー
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  Int $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('m_product_category_id', $category);
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
            $query->whereRaw("products.name LIKE '%$keyword%'");
        });
    }

    /**
     * お気に入り
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  Int $uid
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMyFavorite($query, $uid)
    {
        return $query->whereHas('favorites', function ($query) use ($uid) {
            $query->where('user_id', $uid);
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
     * 人気商品を順番に取得
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFavorite($query)
    {
        return
            $query->whereHas('favorites')
                ->withCount('favorites')
                ->orderBy('favorites_count', 'desc');
    }

    /**
     * orderの昇順で表示
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrder($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
