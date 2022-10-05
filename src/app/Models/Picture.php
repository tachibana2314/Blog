<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Storage;
use Carbon\Carbon;


class Picture extends Model
{
    protected $fillable = [
        'product_id',
        'path',
        'type',
        'created_at',
        'updated_at',
    ];


    private $url;
    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Custom Methods
    |--------------------------------------------------------------------------
    */
    public function getImageUrls(Builder $builder)
    {
        return $builder->where('product_id', $this->product()->id)->get();
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
