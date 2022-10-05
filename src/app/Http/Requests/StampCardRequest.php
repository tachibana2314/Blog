<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StampCardRequest extends FormRequest
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
            'stamp_count' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
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
            'title' => 'カード名',
            'description' => '説明文',
            'stamp_count' => '合計スタンプ数',
            'start_date' => '利用期間',
            'end_date' => '利用期間',
            'status' => 'ステータス',
        ];
    }
}
