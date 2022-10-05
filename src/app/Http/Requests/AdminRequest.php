<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AdminRequest extends FormRequest
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
            'email' => 'required|string|max:255',
            'first_name' => 'required',
            'last_name' => 'required',
            'last_name_kana' => ['required', 'string', 'max:50', 'regex:/^[ァ-ン]+$/u'],
            'first_name_kana' => ['required', 'string', 'max:50', 'regex:/^[ァ-ン]+$/u'],
            'password' => 'required|string|min:6|confirmed',
            'old_password' => ' required',
            'password_confirmation' => ' required',
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => '名',
            'last_name' => '性',
            'first_name_kana' => '名（カナ）',
            'last_name_kana' => '性（カナ）',
            'email' => 'メールアドレス',
            'old_password' => '仮パスワード',
            'password' => '新しいパスワード',
            'password_confirmation' => '確認用パスワード',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attributeを入力してください'
        ];
    }
}
