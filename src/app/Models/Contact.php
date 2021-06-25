<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contact extends Model
{
    private const SERVICE = 1;
    private const RECRUITE = 2;
    private const ACCOUNT = 3;
    private const RESERVE = 4;
    private const OTHER = 5;
    private const FRANCHISE = 6;

    public const CONTACT_TYPE_LIST = [
        self::SERVICE => 'サービスについて',
        self::RECRUITE => '採用について',
        self::ACCOUNT => 'アカウントについて',
        self::RESERVE => '予約について',
        self::FRANCHISE => 'フランチャイズについて',
        self::OTHER => 'その他',
    ];

    private const UN_SUPPORT = 1;
    private const PROGRESS = 2;
    private const SUPPORT = 3;

    public const CONTACT_STATUS_LIST = [
        self::UN_SUPPORT => '未対応',
        self::PROGRESS => '対応中',
        self::SUPPORT => '対応済み',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $fillable = [
        'last_name',
        'first_name',
        'first_name_kana',
        'last_name_kana',
        'email',
        'tel',
        'type',
        'status',
        'content',
        'memo',
    ];

    public function getCreatedAtttribute()
    {
        return Carbon::parse($this->created_at)->format('Y-m-d');
    }


    /**
     *お問合せ種別
     */
    public function getTypeAttribute($type): string
    {
        return self::CONTACT_TYPE_LIST [$type];
    }

    public static function contactType($type)
    {
        return self::CONTACT_TYPE_LIST [$type];
    }

    public function getStatusLabelAttribute(): string
    {
        return self::CONTACT_STATUS_LIST [$this->status];
    }

    public function getStatusClassAttribute()
    {
        switch ($this->status) {
            case self::UN_SUPPORT:
                return 'label label--error';
            case self::PROGRESS:
                return 'label';
            case self::SUPPORT:
                return 'label label--correct';
        }
    }

    public function getFullNameAttribute()
    {
        return $this->last_name. ' '. $this->first_name;
    }

    public function getFullNameKanaAttribute()
    {
        return $this->last_name_kana. ' '. $this->first_name_kana;
    }

}
