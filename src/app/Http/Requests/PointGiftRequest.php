<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PointGiftRequest extends FormRequest
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
            'name' => 'required',
            'point' => 'required',
            'status' => 'required',
            // 'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attributeは入力必須です',
            'numeric' => ':attributeは数値を入力してください'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'ポイント景品名',
            'point' => 'ポイント',
            'description' => 'ポイント景品説明',
            'status' => 'ステータス',
        ];
    }
}
