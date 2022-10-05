<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
            'pic_path' => 'required',
            'status' => 'required',
            'type' => 'required',
        ];
    }

    // カスタムバリデーション
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $this->all();
            if ($data['type'] == 1) {
                $this->validate(
                    ['information_id' => 'required'],
                    ['information_id.required' => ':attributeは必須項目になります'],
                    ['information_id' => '対象お知らせ']
                );
            }
            if ($data['type'] == 2) {
                $this->validate(
                    ['product_id' => 'required'],
                    ['product_id.required' => ':attributeは必須項目になります'],
                    ['product_id' => '対象商品']
                );
            }
            if ($data['type'] == 3) {
                $this->validate(
                    ['coupon_id' => 'required'],
                    ['coupon_id.required' => ':attributeは必須項目になります'],
                    ['coupon_id' => '対象クーポン']
                );
            }
            if ($data['type'] == 4) {
                $this->validate(
                    ['store_id' => 'required'],
                    ['store_id.required' => ':attributeは必須項目になります'],
                    ['store_id' => '対象店舗']
                );
            }
            if ($data['type'] == 5) {
                $this->validate(
                    ['url' => 'required'],
                    ['url.required' => ':attributeは必須項目になります'],
                    ['url' => '外部URL']
                );
            }
            if ($data['type'] == 6) {
                $this->validate(
                    ['stamp_id' => 'required'],
                    ['stamp_id.required' => ':attributeは必須項目になります'],
                    ['stamp_id' => '対象スタンプカード']
                );
            }
        });
    }

    public function messages()
    {
        return [
            '*.required' => ':attributeは入力必須です',
        ];
    }

    public function attributes()
    {
        return [
            'pic_path' => 'スライド画像',
            'status' => 'ステータス',
            'type' => 'タイプ',
        ];
    }
}
