<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use App\Mail\EmailVerification;
use Mail;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Http\Requests\AdminRequest;


class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/admin/home';



    protected function validator(array $data)
    {

        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:admins|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        $this->validator($data)->validate();
        $random_password = Str::random(12);

        $admin = Admin::create([
            'email' => $data['email'],
            'password' => Hash::make($random_password),
            'email_verify_token' => base64_encode($data['email']),
        ]);

        $email = new EmailVerification($admin, $random_password);
        Mail::to($admin->email)->send($email);

        return $admin;
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function register(Request $request)
    {
        event(new Registered($this->create($request->all())));

        return redirect()->route('admin.member')->with('message', '入力されたメールに招待メールを送信しました');
    }

    public function showForm($email_token)
    {
        // 使用可能なトークンか
        if (!Admin::where('email_verify_token', $email_token)->exists()) {
            return redirect()->route('admin.login')->with('message_error', '無効なトークンです。');
        } else {
            $admin = Admin::where('email_verify_token', $email_token)->first();
            // 本登録済みユーザーか

            if (isset($admin->status) && $admin->status) {
                return redirect()->route('admin.login')->with('message', 'すでに本登録されています。ログインして利用してください。');
            }

            $admin->email_verified_at = Carbon::now();
            if ($admin->save()) {
                return view('admin.member.register', compact('email_token', 'admin'));
            } else {
                return redirect()->route('admin.login')->with('message_error', 'メール認証に失敗しました。再度、メールからリンクをクリックしてください。');
            }
        }
    }
    protected function firstUpdate($email_token, AdminRequest $request)
    {
        // 使用可能なトークンか
        if (!Admin::where('email_verify_token', $email_token)->exists()) {
            return redirect()->route('admin.login')->with('message_error', '無効なトークンです。');
        } else {
            $admin = Admin::where('email_verify_token', $email_token)->first();
            // 本登録済みユーザーか

            if (isset($admin->status) && $admin->status) {
                return redirect()->route('admin.login')->with('message', 'すでに本登録されています。ログインして利用してください。');
            }
            $data = $request->all();

            $this->updateValidator($data, $admin)->validate();
            //現在のパスワードがあっているかチェック
            if (!\Hash::check($data['old_password'], $admin->password)) {
                return redirect()->back()->withInput()->with('message_error', '仮パスワードが違います');
            }
            //現在のパスワードとリセットパスワードと同じ場合
            if (Hash::check($request->input('password'), $admin->password)) {
                return redirect()->back()->withInput()->with('message_error', '仮パスワードとは違うパスワード入力お願いします。');
            }
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);


            $admin->fill($data);

            //編集を完了したかの確認
            $admin->status = 1;

            if ($admin->save()) {
                return redirect()->route('admin.member')->with('message', 'ログインに成功しました');
            } else {
                return redirect()->route('admin.login')->with('message_error', 'メール認証に失敗しました。再度、メールからリンクをクリックしてください。');
            }
        }
    }

    protected function updateValidator(array $data, $admin)
    {
        return Validator::make($data, [
            'email' => [
                'required',
                'max:255',
                'string',
                Rule::unique('admins')->ignore($admin->id)
            ],
            'old_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
}
