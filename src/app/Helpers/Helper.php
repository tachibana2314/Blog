<?php

namespace App\Helpers;

class Helper
{
    /**
     * 配列変換関数
     *
     * 半角スペース || 全角スペースを配列変換
     */
    public static function space_array_conversion(String $keyword)
    {
        $half_space_string = mb_convert_kana($keyword, "s"); // 全角スペースを半角スペースに置換
        $search_array = explode(" ", $half_space_string); // 配列に変換
        return $search_array;
    }
}
