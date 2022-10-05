<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StampCouponRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'path_main' => 'required',
//             'barcode' => 'required',
            'stamp_count' => 'required',
            'use_period' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attributeは入力必須です',
            '*.after' => '終了日は開始日以降に設定してください',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'クーポン名',
            'path_main' => 'メイン写真',
            'barcode' => 'バーコード写真',
            'description' => 'クーポン説明',
            'stamp_count' => 'セットスタンプ数',
            'use_period' => 'ご利用期間',
            'status' => 'ステータス',
        ];
    }
}
