<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;

class StampCard extends Model
{
    protected $table = 'stamp_cards';
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title',
        'description',
        'stamp_count',
        'status',
        'release_date',
        'start_date',
        'end_date',
    ];

    public $sortable = [
        'id',
        'title',
        'description',
        'stamp_count',
        'status',
        'start_date',
        'end_date',
        'release_date',
    ];

    public function stampCoupon()
    {
        return $this->hasMany('App\Models\StampCoupon', 'card_id');
    }

    public function slides()
    {
        return $this->hasMany('App\Models\Slide', 'stamp_id');
    }


    const STATUS_RELEASED = 1;
    const STATUS_PRIVATE = 2;
    const STATUS_DRUFT = 3;

    public function setStatusClass()
    {
        switch ($this->status) {
            case self::STATUS_RELEASED:
                return 'status_release';
            case self::STATUS_PRIVATE:
                return 'status_private';
            case self::STATUS_DRUFT:
                return 'status_druft';
        }
    }

    public function setStatusLabel()
    {
        switch ($this->status) {
            case self::STATUS_RELEASED:
                return '公開';
            case self::STATUS_PRIVATE:
                return '非公開';
            case self::STATUS_DRUFT:
                return '下書き';
        }
    }

    // 公開中
    public function scopePublished($query)
    {
        return $query->where('status', 1)
            ->where('start_date', '<=', date('Y-m-d'))
            ->where('end_date', '>=', date('Y-m-d'));
    }
}
