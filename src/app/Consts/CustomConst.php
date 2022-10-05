<?php

namespace App\Consts;

class CustomConst
{
    const GENDER = [
        1 => '女性',
        2 => '男性'
    ];

    const STATUS = [
        1 => '公開',
        2 => '非公開',
    ];

    const USER_STATUS = [
        1 => 'アクティブ',
        2 => '退会済み',
    ];

    const COUPON_STATUS = [
        1 => '公開',
        2 => '非公開',
        // 3 => '下書き',
    ];

    const ALLERGY = [
        1 => 'Egg',
        2 => 'Milk',
        3 => 'Wheat',
        4 => 'Backwheat',
        5 => 'Peanut',
        6 => 'Shrimp',
        7 => 'Crab',
        8 => 'Soybean',
        9 => 'Gelatin',
    ];

    const TYPE = [
        1 => 'お知らせ',
        2 => '商品',
        3 => 'クーポン',
        4 => '店舗',
        5 => '外部URL',
        6 => 'スタンプ',
    ];

    const COUPON_TYPE = [
        1 => '通常クーポン',
        2 => '誕生日クーポン',
    ];

    const ORDER = [
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
    ];

    const TARGET_MONTH = [
        1 => '1月',
        2 => '2月',
        3 => '3月',
        4 => '4月',
        5 => '5月',
        6 => '6月',
        7 => '7月',
        8 => '8月',
        9 => '9月',
        10 => '10月',
        11 => '11月',
        12 => '12月',
    ];

    // 一覧に表示する件数
    const ACQUISITIONS = 10;

    const DISPLAYD_NUMBER = 10;

    // プッシュURL
    const CURLOPT_URL = "https://exp.host/--/api/v2/push/send";

    // limited Or Popular
    const LIMITED_FLG = 1;
    const POPULAR_FLG = 2;
}
