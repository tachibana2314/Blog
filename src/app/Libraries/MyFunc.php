<?php

namespace App\Libraries;

use DB;

class MyFunc
{


    //存在判定(１，値,2ステータス,3falseだった場合に返す値)
    public static function ckExist($array = null, $key, $default = false)
    {
        if (isset($key) && $key && isset($array) && $array) {
            return $array[$key];
        } else {
            return $default;
        }
    }
    //存在判定(１，値,2ステータス,3falseだった場合に返す値)
    public static function getArraymodel($model = null)
    {
        $model = DB::table($model)->orderBy('id', 'asc')->pluck('name', 'id');
        return $model;
    }

    public static function checkRole()
    {
        if (\Auth::user()->role == 1) {
            return false;
        } elseif (\Auth::user()->role == 9) {
            return true;
        } else {
            return false;
        }
    }
}
