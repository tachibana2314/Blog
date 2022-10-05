<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * ポイント履歴の取得
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $points = collect([]);
            $max = 0;

            $request->merge(['uid' => 37]);

            // ユーザーがサインインしている場合
            if (!empty($request['uid'])) {
                // ユーザー
                $user = User::find($request['uid']);
                if ($user) {
                    // ポイント履歴
                    $points = $user->points()
                        ->orderBy('id', 'desc');
                    $max = $points->count();
                    if ($request['more'] === 'true') {
                        $points = $points->more($request['length'])->get();
                    } else {
                        $points = $points->index()->get();
                    }
                }
            }

            $points = $points->map(function ($point) {
                    $point_gift = $point->point_gift;
                    $purchase = $point->purchase;
                    return [
                        'id' => $point->id,
                        'type' => $point->type,
                        'acquired_at' => $point->acquired_at ? strtotime($point->acquired_at) : null,
                        'expired_at' => $point->expired_at ? strtotime($point->expired_at) : null,
                        'used_at' => $point->used_at ? strtotime($point->used_at) : null,
                        'amount' => $point->amount,
                        'residue' => $point->residue,
                        'use' => $point->use,
                        'point_gift' => [
                            'id' => data_get($point_gift, 'id'),
                            'name' => data_get($point_gift, 'name'),
                        ],
                        'purchase' => $purchase ? [
                            'id' => $purchase->id,
                            'purchase_timestamp' => $purchase->purchase_timestamp,
                            'sub_total' => $purchase->sub_total,
                            'tax' => $purchase->tax,
                            'total' => $purchase->total,
                            'purchase_products' => $purchase
                                ->purchase_products
                                ->map(function ($purchase_product) {
                                    return [
                                        'name' => $purchase_product->name,
                                        'price' => $purchase_product->price,
                                        'tax' => $purchase_product->tax,
                                        'quantity' => $purchase_product->quantity,
                                        'currency' => $purchase_product->currency,
                                    ];
                                })
                                ->toArray(),
                        ] : null,
                    ];
                })
                ->toArray();

            return response()->json([
                'points' => $points,
                'max' => $max,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * 合計ポイントの取得
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function total(Request $request)
    {
        try {
            $request->merge(['uid' => 37]);

            $total = 0;
            // ユーザーがサインインしている場合
            if (!empty($request['uid'])) {
                // ユーザー
                $user = User::find($request['uid']);
                $total = $user->available_point;
            }
            return response()->json([
                'total' => $total,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }
}
