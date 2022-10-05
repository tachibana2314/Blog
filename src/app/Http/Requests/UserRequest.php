<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;


class UserRequest extends FormRequest
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
            'email' => 'required|unique:users,email,',
            // 'gender' => 'required',
            'birthday' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => ' required_with:password',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attributeを入力してください。',
            'email.unique' => 'このメールアドレスはすでに使用されています',

        ];
    }

    public function attributes()
    {
        return [
            'nickname' => 'ニックネーム',
            'password' => '新しいパスワード',
            'email' => 'メールアドレス',
            'birthday' => '誕生日',
            'password_confirmation' => '確認用パスワード',
        ];
    }
}
