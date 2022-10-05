<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;


class UpdateUserRequest extends FormRequest
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
    public function rules(User $user)
    {
        return [
            'nickname' => 'required|string|max:50',
            'email' => 'required|unique:users,email,' . $this->user->id,
//            'gender' => 'required',
            'birthday' => 'required',
            'password' => ' required_with:old_password,password_confirmation',
            'old_password' => ' required_with:password,password_confirmation',
            'password_confirmation' => ' required_with:password,old_password',
        ];
    }


    // パスワード変更時のみバリデーション
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $this->all();
            if ($data['password']) {
                $this->validate(
                    [
                        'password' => 'required_with:password|string|min:6|confirmed',
                        'password_confirmation' => 'required_with:password|same:password|string|min:6|',
                    ],
                    [
                        'password.required_with' => ':attributeは必須項目になります。',
                        'password_confirmation.required_with'  => ':attributeは必須項目になります。',
                    ],
                    [
                        'password' => 'パスワード',
                        'password_confirmation' => '確認用パスワード',
                    ]
                );
            }
        });
    }

    public function messages()
    {
        return [
            '*.required' => ':attributeを入力してください。',
            '*.required_with' => ':attributeは必須項目です。',
            'email.unique' => 'このメールアドレスはすでに使用されています',
        ];
    }

    public function attributes()
    {
        return [
            'nickname' => 'ニックネーム',
            'email' => 'メールアドレス',
            'birthday' => '誕生日',
            'old_password' => '現在のパスワード',
            'password' => '新しいパスワード',
            'password_confirmation' => '確認用パスワード',
        ];
    }
}
