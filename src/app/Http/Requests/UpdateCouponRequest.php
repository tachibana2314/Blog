<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
            'product_id' => 'required',
            'description' => 'required',
            'status' => 'required',
            'type' => 'required',
            'release_date' => 'required',
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
            'product_id' => 'クーポン適用商品',
            'description' => 'クーポン説明',
            'status' => 'ステータス',
            'type' => 'クーポンタイプ',
            'release_date' => '公開日',
        ];
    }
    // カスタムバリデーション
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $this->all();
            if ($data['type'] == 1) {
                $this->validate(
                    [
                        'start_date' => 'required',
                        'end_date' => 'required|date|after:start_date',
                    ],
                    ['*.required' => ':attributeは必須項目になります'],
                    [
                        'start_date' => 'ご利用開始日',
                        'end_date' => 'ご利用終了日',
                    ]
                );
            }
            if ($data['type'] == 2) {
                $this->validate(
                    ['target_month' => 'required'],
                    ['target_month.required' => ':attributeは必須項目になります'],
                    ['target_month' => '対象月']
                );
            }
        });
    }
}
