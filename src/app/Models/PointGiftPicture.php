<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Storage;
use Carbon\Carbon;


class PointGiftPicture extends Model
{
    protected $fillable = [
        'point_gift_id',
        'path',
        'created_at',
        'updated_at',
    ];


    private $url;
    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */
    public function point_gift()
    {
        return $this->belongsTo('App\Models\PointGift');
    }

    /*
    |--------------------------------------------------------------------------
    | Custom Methods
    |--------------------------------------------------------------------------
    */
    public function getImageUrls(Builder $builder)
    {
        return $builder->where('point_gift_id', $this->point_gift()->id)->get();
    }

    /**
     * S3画像表示
     *
     * @return String
     */
    public function getUrlAttribute()
    {
        $this->url = asset('img/img_noimg.svg');

        if ($path = $this->path) {

            $this->url = Storage::disk('s3')->url($path);
        }

        return $this->url;
    }
}
