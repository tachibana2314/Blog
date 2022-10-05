<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;

class Admin extends Authenticatable
{
    use Notifiable;
    use Sortable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'first_name_kana',
        'last_name_kana',
        'department',
        'position',
        'remember_token',
        // メール認証で必要
        'email_verify_token',
        'email_verified_at',
    ];

    protected $sortable = [
        'id',
        'email',
        'first_name',
        'last_name',
        'first_name_kana',
        'last_name_kana',
        'department',
        'position',
        'created_at',
    ];

    public function fullNameSortable($query, $direction)
    {
        return $query->orderBy('last_name', $direction)->orderBy('first_name', $direction);
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Custom Methods
    |--------------------------------------------------------------------------
    */
    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->first_name}";
    }
    public function getFullNameKanaAttribute()
    {
        return "{$this->last_name_kana} {$this->first_name_kana}";
    }

    public function generateTableData()
    {
        $data = config('tabledata.admin');


        // 管理者ID
        $data[0]['data'] = $this->id;
        // 氏名
        $data[1]['data'] = "$this->last_name $this->first_name";
        // 部署
        $data[2]['data'] = $this->department;
        // 役職
        $data[3]['data'] = $this->position;
        // メールアドレス
        $data[4]['data'] = $this->email;
        // 登録日
        $data[5]['data'] = $this->created_at;
        $data[6]['data'] = $this->last_login_at;
        return $data;
    }
}
