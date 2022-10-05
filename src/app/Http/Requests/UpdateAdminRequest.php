<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UpdateAdminRequest extends FormRequest
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
            'email' => 'unique:admins,email,' . $this->admin->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'last_name_kana' => ['required', 'string', 'max:50', 'regex:/^[ァ-ン]+$/u'],
            'first_name_kana' => ['required', 'string', 'max:50', 'regex:/^[ァ-ン]+$/u'],
            'password' => ' required_with:old_password,password_confirmation',
            'old_password' => ' required_with:password,password_confirmation',
            'password_confirmation' => ' required_with:password,old_password',
        ];
    }
    public function messages()
    {
        return [
            '*.required' => ':attributeを入力してください。',
            '*.required_with' => ':attributeは必須項目です。',
            'email.unique' => 'このEメールアドレスはすでに使用されています',
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => '名',
            'last_name' => '姓',
            'first_name_kana' => '名（カナ）',
            'last_name_kana' => '性（カナ）',
            'email' => 'メールアドレス',
            'old_password' => '現在のパスワード',
            'password' => '新しいパスワード',
            'password_confirmation' => '確認用パスワード',
        ];
    }
}
