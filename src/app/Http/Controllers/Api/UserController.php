<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * 該当ユーザーの取得
     *
     * @param \Illuminate\Http\Request $request
     * @return App\Models\User
     */
    private function getUserByEmail(Request $request)
    {
        return User::whereEmail($request['loggedInEmail'])->first();
    }

    /**
     * ログインユーザーの取得
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        try {
            $user = User::find($request['uid']);
            if ($user) {
                return response()->json($user, 200);
            } else {
                return response()->json(null);
            }
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * サインイン
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signIn(Request $request)
    {
        try {
            $user = $this->getUserByEmail($request);
            if ($user) {
                $user->logged_in_at = new Carbon();
                $user->save();
                return response()->json($user, 200);
            } else {
                return response()->json(null);
            }
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * サインアップ
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signUp(Request $request)
    {
        try {
            $user = User::create([
                'birthday' => $request['birthday'] ? new Carbon($request['birthday']) : null,
                'email' => $request['email'],
                'gender' => $request['gender'],
                'logged_in_at' => Carbon::now(),
                'nickname' => $request['nickname'],
                'password' => Hash::make($request['password']),
            ]);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * 更新
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try {
            $user = User::find($request['uid']);
            if ($user) {
                if ($request['password']) {
                    $user->fill(['password' => Hash::make($request['password'])])->save();
                } else {
                    $user->fill($request->all())->save();
                }
                return response()->json(200);
            } else {
                return response()->json(401);
            }
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * 退会
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function quit(Request $request)
    {
        try {
            $user = User::find($request['uid']);
            $user->fill([
                'email' => $user->email.'@'.Carbon::now(),
                'left_at' => Carbon::now()
            ])
            ->save();
            return response()->json(200);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }
}
