<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminSearch;
use App\Repositories\AdminRepositoryInterface;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Hash;
use Auth;

class MemberController extends Controller
{
    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index(Request $request)
    {
        $search = new AdminSearch();
        $admin = new Admin;
        $params = $request->query();
        $admin = $this->adminRepository->search($search->fill($params))
            ->sortable()
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.member.index', [
            'title' => '管理者管理',
            'admin' => $admin,
            'search' => $search,
        ]);
    }

    public function add()
    {
        return view('admin.member.add.index', [
            'title' => '管理者追加',
        ]);
    }

    public function detail(Admin $admin)
    {
        // ログインユーザー情報取得
        $login_admin = Auth::user();

        return view('admin.member.detail', [
            'title' => '管理者詳細',
            'admin' => $admin,
            'login_admin' => $login_admin,
        ]);
    }

    public function edit(Admin $admin)
    {

        return view('admin.member.edit', [
            'title' => '管理者編集',
            'admin' => $admin,
        ]);
    }

    public function update(Admin $admin, UpdateAdminRequest $request)
    {
        $data = $request->all();
        if ($data['password']) {
            $request->validate(
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
        if ($request->old_password) {
            //現在のパスワードがあっているかチェック
            if (!\Hash::check($data['old_password'], $admin->password)) {
                return redirect()->back()->withInput()->with('message_error', '現在のパスワードが違います');
            }
            //現在のパスワードとリセットパスワードと同じ場合
            if (Hash::check($request->input('password'), $admin->password)) {
                return redirect()->back()->withInput()->with('message_error', 'このパスワードは現在のパスワードとして登録されています。');
            }
            $admin->fill([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'first_name_kana' => $data['first_name_kana'],
                'last_name_kana' => $data['last_name_kana'],
                'department' => $data['department'],
                'position' => $data['position'],
                'password' => Hash::make($data['password']),
            ]);
        }

        if (!$request->old_password) {
            $admin->fill([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'first_name_kana' => $data['first_name_kana'],
                'last_name_kana' => $data['last_name_kana'],
                'department' => $data['department'],
                'position' => $data['position'],
            ]);
        }
        $admin->save();


        return redirect()->route('admin.member.detail', $admin)->with('message', "管理者情報を更新しました。");
    }

    public function delete($id)
    {
        $admin = Admin::find($id);
        $admin->delete($id);
        return redirect()->route('admin.member')->with('message', "管理者情報を削除しました");
    }
}
