<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * 購入履歴の取得
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $purchases = collect([]);
            $max = 0;

            $request->merge(['uid' => 37]);

            // ユーザーがサインインしている場合
            if (!empty($request['uid'])) {
                // ユーザー
                $user = User::find($request['uid']);
                if ($user) {
                    // 購入履歴
                    $purchases = $user->purchases()
                        ->orderBy('purchase_timestamp', 'desc');
                    $max = $purchases->count();
                    if ($request['more'] === 'true') {
                        $purchases = $purchases->more($request['length'])->get();
                    } else {
                        $purchases = $purchases->index()->get();
                    }
                }
            }

            $purchases = $purchases->map(function ($purchase) {
                return [
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
                ];
            })
            ->toArray();
            
            return response()->json([
                'purchases' => $purchases,
                'max' => $max,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }
}
