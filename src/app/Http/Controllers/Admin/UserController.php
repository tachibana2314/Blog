<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Favorite;
use App\Models\CouponHistory;
use App\Models\UserSearch;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepositoryInterface;
use Kreait\Firebase\Auth;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    private $auth;

    public function __construct(UserRepositoryInterface $userRepository, Auth $auth)
    {
        $this->userRepository = $userRepository;
        $this->auth = $auth;
    }

    public function index(Request $request)
    {

        $search = new UserSearch();
        $user = new User;
        $params = $request->query();
        $user = $this->userRepository->search($search->fill($params))
            ->sortable()
            ->withCount('favorites')
            ->withCount('couponHistories')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.user.index', [
            'title' => '顧客管理',
            'user' => $user,
            'search' => $search,
        ]);
    }

    public function userExport()
    {
        $this->userRepository->userExport();
    }

    public function add()
    {
        return view('admin.user.add.index', [
            'title' => '顧客追加',
        ]);
    }
    public function store(UserRequest $request, Auth $auth)
    {
        $data = $request->all();
        $user = User::create([
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'birthday' => $data['birthday'],
            // 'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
        ]);

        //Firebase Authenticationに新規追加
        $userProperties = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];
        $createdUser = $auth->createUser($userProperties);

        return redirect()->route('admin.user')->with('message', "顧客情報を追加しました。");
    }

    public function detail(User $user)
    {
        $favorites = (new Favorite())
            ->select('favorites.*')
            ->groupBy('favorites.id')
            ->leftJoin('users', 'favorites.user_id', '=', 'users.id')
            ->where('favorites.user_id', $user->id)
            ->orderBy('favorites.id', 'desc')
            ->paginate(5, ["*"], 'productpage');

        $coupon_histories = (new CouponHistory())
            ->select('coupon_histories.*')
            ->groupBy('coupon_histories.id')
            ->leftJoin('users', 'coupon_histories.user_id', '=', 'users.id')
            ->where('coupon_histories.user_id', $user->id)
            ->orderBy('coupon_histories.id', 'desc')
            ->paginate(5, ["*"], 'couponpage');

        $points = $user
            ->points()
            ->select('points.*')
            ->leftJoin('users', 'points.user_id', '=', 'users.id')
            ->leftJoin('point_gifts', 'points.point_gift_id', '=', 'point_gifts.id')
            ->groupBy('points.id')
            ->orderBy('points.id', 'desc')
            ->paginate(5, ["*"], 'pointpage');

        return view('admin.user.detail', [
            'title' => '顧客詳細',
            'user' => $user,
            'favorites' => $favorites,
            'coupon_histories' => $coupon_histories,
            'points' => $points,
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', [
            'title' => '顧客情報編集',
            'user' => $user,
        ]);
    }

    public function update(User $user, UpdateUserRequest $request, Auth $auth)
    {
        $data = $request->all();

        DB::beginTransaction();
        try {
            $f_user = $auth->getUserByEmail($user->email);
            $uid = $f_user->uid;
            // パスワード入力した時のUPDATE
            if ($request->old_password) {
                //現在のパスワードがあっているかチェック
                if (!\Hash::check($data['old_password'], $user->password)) {
                    return back()->with('message_error', '現在のパスワードが違います');
                }
                //現在のパスワードとリセットパスワードと同じ場合
                if (Hash::check($request->input('password'), $user->password)) {
                    return redirect()->back()->withInput()->with('message_error', 'このパスワードは現在のパスワードとして登録されています。');
                }
                $user->fill([
                    'nickname' => $data['nickname'],
                    // 'gender' => $data['gender'],
                    'email' => $data['email'],
                    'birthday' => $data['birthday'],
                    'password' => Hash::make($data['password']),
                ]);
            }
            // パスワード入力しない時のUPDATE
            if (!$request->old_password) {
                $user->fill([
                    'nickname' => $data['nickname'],
                    // 'gender' => $data['gender'],
                    'email' => $data['email'],
                    'birthday' => $data['birthday'],
                ]);
            }
            //Firebase AuthenticationにUPDATE
            $properties = [
                'email' => $data['email'],
            ];
            // パスワード入力した時のFirebase AuthenticationにUPDATE
            if ($request->old_password) {
                $properties = [
                    'email' => $data['email'],
                    'password' => $data['password'],
                ];
            }
            $updatedUser = $auth->updateUser($uid, $properties);
            $user->save();
        } catch (\Exception $e) {
            DB::rollback();
            // firebaseとDBのユーザー情報がどちらかない
            return back()->withInput()->with('message_error', "顧客情報追編集に失敗しました。");
        }
        DB::commit();

        $properties = [
            'displayName' => 'New display name'
        ];
        return redirect()->route('admin.user')->with('message', "顧客情報を更新しました。");
    }

    public function delete($id, Auth $auth)
    {
        $user = User::find($id);
        // firebase登録ユーザー取得
        $f_user = $auth->getUserByEmail($user->email);
        $uid = $f_user->uid;

        $auth->deleteUser($uid);
        $user->delete($id);
        return redirect()->route('admin.user')->with('message', "顧客情報を削除しました");
    }
}
