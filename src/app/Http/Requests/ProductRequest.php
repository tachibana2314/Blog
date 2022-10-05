<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'm_product_category_id' => 'required',
            'price' => 'required',
            'calory' => 'nullable|numeric',
            'status' => 'required',
            // 'description' => 'required',
            'online_flg',
            'limited_flg',
            'start_date',
            'end_date',
            'path' => $this->route('product') ? '' : 'required',
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
            'name' => '商品名',
            'price' => '価格',
            'description' => '商品説明',
            'calory' => 'カロリー',
            'status' => 'ステータス',
            'm_product_category_id' => 'カテゴリー',
            'path' => '商品画像',
        ];
    }

    // カスタムバリデーション
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $this->all();
            if (isset($data['limited_flg'])) {
                $this->validate(
                    [
                        'start_date' => 'required|date',
                        'end_date' => 'required|date|after:start_date',
                        'release_date' => 'required|date'
                    ],
                    ['*.required' => ':attributeは必須項目になります'],
                    [
                        'start_date' => '期間開始日',
                        'end_date' => '期間終了日',
                        'release_date' => '公開日'
                    ]
                );
            }
        });
    }
}
