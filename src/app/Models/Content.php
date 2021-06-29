<?php

namespace App\Models;

use App\Traits\GetImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Content extends Model
{
    use GetImageTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contents';

    protected $guarded = [
        '_token',
    ];

    const STATUS_1 = 1;
    const STATUS_2 = 2;
    const STATUS_LIST = [
        self::STATUS_1 => '公開',
        self::STATUS_2 => '非公開',
    ];

    const CONTENT_TYPE_1 = 1;
    const CONTENT_TYPE_2 = 2;
    const CONTENT_TYPE_3 = 3;
    const CONTENT_TYPE_LIST = [
        self::CONTENT_TYPE_1 => 'Webサイト',
//        self::CONTENT_TYPE_2 => 'マイページ',
//        self::CONTENT_TYPE_3 => 'アプリ',
    ];

    const CATEGORY_NEWS = 1;
    const CATEGORY_INFO = 2;

    const CATEGORY_LIST = [
        self::CATEGORY_NEWS => 'News',
        self::CATEGORY_INFO => 'Info',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function textCategory()
    {
        return $this->belongsTo('App\Models\TextCategory');
    }

    /*
    |--------------------------------------------------------------------------
    | Custum Methods
    |--------------------------------------------------------------------------
    */

    /**
     * 取得 サムネイル
     *
     * @return String
     */
    public function getThumbnailAttribute()
    {
        if (!$this->image_path) {
            return null;
        } else {
            return $this->getTemporaryImageUrl($this->image_path);
        }
    }

    public function getCategoryLabelAttribute()
    {
        $result = Arr::get($this::CATEGORY_LIST, $this->text_category_id, null);

        return $result;
    }

    public function getWebReleaseLabelAttribute()
    {
        $result = Arr::get($this::STATUS_LIST, $this->web_release, null);

        return $result;
    }

    public function getMypageReleaseLabelAttribute()
    {
        $result = Arr::get($this::STATUS_LIST, $this->mypage_release, null);

        return $result;
    }

    public function getAppReleaseLabelAttribute()
    {
        $result = Arr::get($this::STATUS_LIST, $this->app_release, null);

        return $result;
    }

    public function getOverviewAttribute()
    {
        return Str::limit(strip_tags($this->body), 100);
    }

    public function getIsHeadlinFlgAttribute()
    {
        return $this->headlin_flg === self::STATUS_1;
    }

    public function getIsWebReleasedAttribute()
    {
        return $this->web_release === self::STATUS_1;
    }

    public function getIsMypageReleasedAttribute()
    {
        return $this->mypage_release === self::STATUS_1;
    }

    public function getIsAppReleasedAttribute()
    {
        return $this->app_release === self::STATUS_1;
    }
}
