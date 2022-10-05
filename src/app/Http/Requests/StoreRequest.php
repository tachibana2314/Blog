<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Store;


class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'tel' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'status' => 'required',
            // 営業時間
            'mon_start_time' => 'required',
            'mon_end_time' => 'required|after:mon_start_time',
            'tue_start_time' => 'required',
            'tue_end_time' => 'required|after:tue_start_time',
            'wed_start_time' => 'required',
            'wed_end_time' =>  'required|after:wed_start_time',
            'thu_start_time' => 'required',
            'thu_end_time' =>  'required|after:thu_start_time',
            'fri_start_time' => 'required',
            'fri_end_time' =>  'required|after:fri_start_time',
            'sat_start_time' => 'required',
            'sat_end_time' =>  'required|after:sat_start_time',
            'sun_start_time' => 'required',
            'sun_end_time' =>  'required|after:sun_start_time',
            'hol_start_time' => 'required',
            'hol_end_time' =>  'required|after:hol_start_time',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attributeは入力必須です',
            '*.after' => '営業終了時間は営業開始時間以降の設定してください',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '店舗名',
            'tel' => '電話番号',
            'address' => '住所',
            'latitude' => '緯度',
            'longitude' => '経度',
            'mon_start_time' => '月曜日営業開始時間',
            'mon_end_time' => '月曜日営業終了時間',
            'tue_start_time' => '火曜日営業開始時間',
            'tue_end_time' => '火曜日営業終了時間',
            'wed_start_time' => '水曜日営業開始時間',
            'wed_end_time' => '水曜日営業終了時間',
            'thu_start_time' => '木曜日営業開始時間',
            'thu_end_time' => '木曜日営業終了時間',
            'fri_start_time' => '金曜日営業開始時間',
            'fri_end_time' => '金曜日営業終了時間',
            'sat_start_time' => '土曜日営業開始時間',
            'sat_end_time' => '土曜日営業終了時間',
            'sun_start_time' => '日曜日営業開始時間',
            'sun_end_time' => '日曜日営業終了時間',
            'hol_start_time' => '祝日営業開始時間',
            'hol_end_time' => '祝日営業終了時間',
            'description' => '店舗説明',
        ];
    }
}
