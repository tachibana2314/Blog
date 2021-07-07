<?php

namespace App\Models;

use App\Traits\GetImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

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
    | Accessor Methods
    |--------------------------------------------------------------------------
    */
    /**
     * 取得 サムネイル
     *
     * @return String
     */
    public function getImageAttribute()
    {
        if (!$this->image_path) {
            return null;
        } else {
            return $this->getTemporaryImageUrl($this->image_path);
        }
    }

    public function getCategoryAttribute()
    {
        $result = Arr::get( config('const.CONTENT_CATEGORY'), $this->category_id, null);

        return $result;
    }

    public function getProgramingCategoryAttribute()
    {
        $result = Arr::get( config('const.PROGRAMMING_CATEGORY'), $this->tag_id, null);

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

    public function getIsReleasedAttribute()
    {
        return $this->release_status === self::STATUS_1;
    }


    /*
    |--------------------------------------------------------------------------
    | Scope
    |--------------------------------------------------------------------------
    */
    public function scopePublished($query)
    {
        return $query->where('release_status', 1)
                    ->where('release_date', '<=', new Carbon());
    }

    public function scopeRecently($query)
    {
        return $query->orderBy('contents.release_date', 'desc');
    }


    public function scopeIndex($query)
    {
        return $query->take(3)->get();
    }

    public function scopePrev($query, $contentId)
    {
        return $query->where('id', '<', $contentId)->orderBy('id', 'desc');
    }

    public function scopeNext($query, $contentId)
    {
        return $query->where('id', '>', $contentId)->orderBy('id');
    }

    public function scopeRecommendation($query)
    {
        return $query->where('recommendation_flg', 1);
    }


    /*
    |--------------------------------------------------------------------------
    | Custum Methods
    |--------------------------------------------------------------------------
    */
}
