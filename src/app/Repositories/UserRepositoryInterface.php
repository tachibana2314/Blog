<?php

namespace App\Repositories;

use App\Models\UserSearch;

interface UserRepositoryInterface
{
    // 指定日のアクティブ会員数取得関数
    public function getUsersInADay(Int $last_day);
    // 指定月のアクティブ会員数取得関数
    public function getUsersInAMonth(Int $last_month);
    public function search(UserSearch $search);
    public function userExport();
}
