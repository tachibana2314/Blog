<?php
namespace App\Traits;

use Storage;
use Carbon\Carbon;

trait GetImageTrait
{
    //<img src="">の場合
    public function getImage($url)
    {
        return $this->getTemporaryImageUrl($url);
    }

    //<div style="">の場合
    public function getImageStyle($url)
    {
        return 'background: url(' . $this->getTemporaryImageUrl($url) . ');';
    }

    //一時URL取得
    public function getTemporaryImageUrl($url)
    {
        return Storage::disk('s3')->temporaryUrl($url, Carbon::now()->addMinute(10));
    }
}
