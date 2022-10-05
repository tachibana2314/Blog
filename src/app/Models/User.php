<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;
use phpDocumentor\Reflection\Types\Integer;

class User extends Model
{
    use SoftDeletes;
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $fillable = [
        'direction',
        'nickname',
        'email',
        'birthday',
        'gender',
        'password',
        'logged_in_at',
        'left_at',
        'created_at',
    ];

    public $sortable = [
        'id',
        'email',
        'nickname',
        'created_at',
        'logged_in_at',
        'left_at',
        'birthday',
        'favoritesCount',
        'couponsCount',
        'gender'
    ];
    // お気に入りソート
    public function favoritesCountSortable($query, $direction)
    {
        return $query->orderBy('favorites_count', $direction);
    }

    // クーポン履歴（使用数）ソート
    public function couponsCountSortable($query, $direction)
    {
        return $query->orderBy('coupon_histories_count', $direction);
    }

    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */

    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
    }

    public function reads()
    {
        return $this->hasMany('App\Models\Read');
    }

    public function couponHistories()
    {
        return $this->hasMany('App\Models\CouponHistory');
    }

    public function purchases()
    {
        return $this->hasMany('App\Models\Purchase');
    }

    public function points()
    {
        return $this->hasMany('App\Models\Point');
    }

    /*
    |--------------------------------------------------------------------------
    | Custom Methods
    |--------------------------------------------------------------------------
    */

    public function getfavoriteCountLabel()
    {
        return $this->favorites->count();
    }

    public function getcouponCountLabel()
    {
        return $this->couponHistories->count();
    }

    /**
     * 性別ラベル
     *
     * @return String
     */
    public function getGenderLabelAttribute()
    {
        if ($this->gender == 1) {
            return '男性';
        } else {
            return '女性';
        }
    }

    /**
     * 誕生月を取得
     *
     * @return Int
     */
     public function getBirthdayMonthAttribute()
     {
         // 誕生日
         $birthday = new Carbon($this->birthday);
         // 誕生月
         $birthday_month = $birthday->month;

         return $birthday_month;
     }

    /**
     * 有効ポイント
     *
     * @return Integer
     */
    public function getAvailablePointAttribute()
    {
        $available_point = 0;

        $points = $this->points()
            ->acquire()
            ->valid()
            ->get();
        foreach ($points as $point) {
            $available_point += $point->residue;
        }

        return $available_point;
    }
}
