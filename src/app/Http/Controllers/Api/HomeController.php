<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * トップのスライド・限定商品・人気商品の取得
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            // スライド
            $slides = Slide::publicPeriod()
                ->orderBy('order', 'asc')
                ->get();
            // 限定
            $limited = Product::open()
                ->withRelations()
                ->limited()
                ->where('limited_flg', 1)
                ->latest()
                ->limit(3)
                ->get();
            // 人気
            $popular = Product::open()
                ->withRelations()
                ->limited()
                ->favorite()
                ->limit(3)
                ->get();

            return response()->json([
                'online' => true,
                'slides' => $slides,
                'limited' => $limited,
                'popular' => $popular,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function getProduct(Request $request)
    {
        return response()->json([
            'product' => Product::WithRelations()->where('id', $request['productId'])->first(),
            'status' => 200
        ]);
    }
}
