<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StampCoupon;
use App\Models\Coupon;
use App\Models\Stamp;
use App\Models\StampCard;
use App\Models\CouponHistory;
use App\Models\CouponLog;
use Carbon\Carbon;
use Illuminate\Http\Request;


class StampCouponController extends Controller
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
                // 取得していないクーポン
                $coupon = StampCoupon::published($request['card_id'])->nocoupon($request['uid']);
                if (!empty($request['uid'])) {
                    $coupon = $coupon->unused($request['uid']);
                }
                $coupon_max = $coupon->count();

                // 取得しているクーポン
                $getCoupons = StampCoupon::published($request['card_id']);
                if (!empty($request['uid'])) {
                    $getCoupons = $getCoupons->getcoupon($request['uid'])->unused($request['uid'])->piriod($request['uid']);
                    $getCoupons_max = $getCoupons->count();
                    $getCoupons = $getCoupons->index()->get();
                }else{
                    $getCoupons_max = 0;
                }

                // 使用したクーポン
                $used_coupon = StampCoupon::published($request['card_id'])->used($request['uid'])->piriod($request['uid']);
                $used_coupon_max = $used_coupon->count();

                if ($request['more'] === 'true') {
                    $coupon = $coupon->more($request['length'])->get();
                    $getCoupons = $getCoupons->more($request['length'])->get();
                    $used_coupon = $used_coupon->more($request['length'])->get();
                } else {
                    $coupon = $coupon->index()->get();
                    $used_coupon = $used_coupon->index()->get();
                }
            

            return response()->json([
                'coupon' => $coupon,
                'getCoupons' => $getCoupons,
                'coupon_max' => $coupon_max,
                'getCoupons_max' => $getCoupons_max,
                'status' => 200,
                'used_coupon_max' => $used_coupon_max,
                'used_coupon' => $used_coupon,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function qrReader(Request $request)
    {
        try {
            if ($request->get('is_delete')) {
                $status = "delete";
            } else {
                $status = "success";
            }
            return response()->json($status, 200);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    // スタンプ保有情報
    public function getStampHistory(Request $request)
    {
        try {
            $stamps = Stamp::where('stamp_card_id', $request['card_id'])->where('user_id', $request['uid'])->get();
            $max = $stamps->count();
            return response()->json([
                'stamps' => $stamps,
                'max' => $max,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getStampLog(Request $request)
    {
        try {
            $stamp_coupon = CouponLog::where('user_id', $request['uid'])->get();
            $max = $stamp_coupon->count();
            return response()->json([
                'stamp_coupon' => $stamp_coupon,
                'max' => $max,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getStamp(Request $request)
    {
        try {
            Stamp::create([
                'user_id' => $request['uid'],
                'stamp_card_id' => $request['stamp_card_id']
            ]);
            return response()->json('Success', 200);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getStampCard(Request $request)
    {
        try {
            $stamp_card = StampCard::published();
            $count = $stamp_card->count();
            if ($count != 0) {
                $stamp_card = $stamp_card->orderBy('start_date', 'ASC')->first();
                $number = $stamp_card->id;
                $description = $stamp_card->description;
                $stamp_count = $stamp_card->stamp_count;
            } else {
                $stamp_card = null;
                $number = null;
                $description = null;
                $stamp_count = null;
            }
            return response()->json([
                'stamp_card' => $stamp_card,
                'count' => $count,
                'number' => $number,
                'description' => $description,
                'stamp_count' => $stamp_count,
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * クーポンの利用
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function onUse(Request $request)
    {
        $coupon =  $request['coupon'];

        try {
            CouponHistory::create([
                'user_id' => $request['uid'],
                'stamp_coupon_id' => $request['couponId']
            ]);
            return response()->json(null, 200);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function couponLog(Request $request)
    {
        $stampCoupon = $request['coupon'];
        $now = Carbon::today();
        $ad = $stampCoupon['use_period'];
        $end_date = $now->addDays($ad);
        try {
            CouponLog::create([
                'user_id' => $request['uid'],
                'coupon_id' => $request['couponID'],
                'start_date' => Carbon::today(),
                'end_date' => $end_date,
            ]);
            return response()->json(null, 200);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function checkScan(Request $request)
    {
        try {
            $user_id = $request['uid'];
            $stamp_card_id = $request['stamp_card_id'];
            $date = $request['now'];
            $stamp_history = Stamp::where('user_id', $user_id)
                ->where('stamp_card_id', $stamp_card_id)
                ->whereDate('created_at', $date)
                ->get();
            $count = $stamp_history->count();
//             if ($stamp_history->count() == null) {
            return response()->json([
                'user_id' => $user_id,
                'count' => $count,
                'coupon_check' => true,
                'stamp_history' => $stamp_history,
            ]);
            /*
                        } else {
                            return response()->json([
                                'count' => $count,
                                'coupon_check' => false,
                                'stamp_history' => $stamp_history,
                            ]);
                        }
            */
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteStamp(Request $request)
    {
        try {
            $stamp = Stamp::where('user_id', $request['uid'])
                ->where('stamp_card_id', $request['stamp_card_id'])
                ->orderBy('id', 'desc')
                ->first();
            if ($stamp) {
                // 取得済みのクーポン削除
                $stamp_coupons = StampCoupon::where('card_id', $request['stamp_card_id'])
                    ->where('stamp_count', $request['my_stamp_count'])
                    ->get();
                $now = Carbon::today();
                foreach ($stamp_coupons as $stamp_coupon) {
                    $couponLog = CouponLog::where('user_id', $request['uid'])
                        ->where('coupon_id', $stamp_coupon->id)
                        ->where('start_date', $now)
                        ->first();
                    if ($couponLog) {
                        $couponLog->delete();
                    }
                }
                $stamp->delete();
            }
            return response()->json('Success', 200);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
