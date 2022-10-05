<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\StampCoupon;
use App\Models\Stamp;
use App\Models\StampCard;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * クーポン一覧の取得
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            // ノーマル
            $type_one = null;
            $type_one_max = 0;
            $type_one = Coupon::published()->normal();
            if (!empty($request['uid'])) {
                $type_one = $type_one->unused($request['uid']);
            }
            $type_one_max = $type_one->count();
            // more
            if ($request['more'] === '1') {
                $type_one = $type_one->more($request['typeOneLength'])->get();
            } else {
                $type_one = $type_one->index()->get();
            }
            // バースデイ
            $type_two = null;
            $type_two_max = 0;
            // 使用済みバースデイ & 使用済みノーマル
            $type_three = null;
            $type_three_max = 0;
            // ユーザーがサインインしている場合
            if (!empty($request['uid'])) {
                // ユーザー
                $user = User::find($request['uid']);
                // 今日
                $today = new Carbon();
                // 今月
                $this_month = $today->month;
                // ユーザーの誕生月が今月 or １ヶ月前の場合
                if ($user->birthday_month == $this_month || $user->birthday_month - 1 == $this_month) {
                    $type_two = Coupon::published()
                        ->birthday($user->birthday_month)
                        ->unused($request['uid']);
                    $type_two_max = $type_two->count();
                }
                
                $type_three = Coupon::published()
                    ->used($request['uid']);
                $type_three_max = $type_three->count();
                
                if ($type_two) {
                    // more
                    if (empty($request['more']) || $request['more'] === '1' || $request['more'] === '3') {
                        $type_two = $type_two->index()->get();
                    } elseif ($request['more'] === '2') {
                        $type_two = $type_two->more($request['typeTwoLength'])->get();
                    }
                }
                if ($type_three) {
                    // more
                    if (empty($request['more']) || $request['more'] === '1' || $request['more'] === '2') {
                        $type_three = $type_three->index()->get();
                    } elseif ($request['more'] === '3') {
                        $type_three = $type_three->more($request['typeThreeLength'])->get();
                    }
                }
            }
            
            // 取得しているクーポン
            $type_stamp = StampCoupon::publish();
            if (!empty($request['uid'])) {
                $type_stamp = $type_stamp->getcoupon($request['uid'])->unused($request['uid'])->piriod($request['uid']);
                $type_stamp_max = $type_stamp->count();
                $type_stamp = $type_stamp->index()->get();
            }else{
                $type_stamp_max = 0;
                $type_stamp = null;
            }

            
            return response()->json([
                'typeOne' => $type_one,
                'typeOneMax' => $type_one_max,
                'typeTwo' => $type_two,
                'typeTwoMax' => $type_two_max,
                'typeThree' => $type_three,
                'typeThreeMax' => $type_three_max,
                'typeStamp' => $type_stamp,
                'typeStampMax' => $type_stamp_max,
                'status' => 200
            ]);
        } catch (\Exception $type_stampe) {
            return response()->json($type_stamp, 500);
        }
    }

    /**
     * 誕生日クーポンの利用
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function onUse(Request $request)
    {
        try {
            CouponHistory::create([
                'user_id' => $request['uid'],
                'coupon_id' => $request['couponId']
            ]);
            return response()->json(null, 200);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }
}
