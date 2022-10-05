<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;

class InfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // authorizeメソッドがfalseを返すと、
        // 403ステータスコードのHTTPレスポンスが自動的に返され、コントローラメソッドは実行されません。
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:100',
            'body' => 'required|string|max:2000',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => ':attributeは入力必須です。',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'body' => '本文',
            'status' => 'ステータス',
            'release_date' => '公開日',
        ];
    }

    // カスタムバリデーション
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $this->all();
            if (!isset($data['push_flg'])) {
                $this->validate(
                    [
                        'status' => 'required',
                        'release_date' => 'required'
                    ],
                    ['*.required' => ':attributeは必須項目になります'],
                    [
                        'status' => 'ステータス',
                        'release_date' => '公開日',
                    ]
                );
            }
        });
    }
}
