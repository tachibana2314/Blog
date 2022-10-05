<?php

namespace App\Http\Controllers\Api;

use App\Consts\CustomConst;
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * 商品一覧の取得
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $products = Product::open()->withRelations()->limited();
            // カテゴリー
            if (!empty($request['category'])) {
                $products = $products->category($request['category']);
            }
            // キーワード
            if (!empty($request['keyword'])) {
                $products = $products->keyword($request['keyword']);
            }
            // limited Or Popular
            if (!empty($request['narrow'])) {
                // limited
                if ($request['narrow'] == CustomConst::LIMITED_FLG) {
                    $products = $products->where('limited_flg', 1)
                        ->orderBy('m_product_category_id', 'asc')
                        ->order();
                // popular
                } elseif ($request['narrow'] == CustomConst::POPULAR_FLG) {
                    $products = $products->favorite();
                }
            } else {
                $products = $products->orderBy('m_product_category_id', 'asc')
                    ->order();
            }
            $max = $products->count();
            if ($request['more'] === 'true') {
                $products = $products->more($request['length'])->get();
            } else {
                $products = $products->index()->get();
            }

            return response()->json([
                'online' => true,
                'products' => $products,
                'max' => $max,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * お気に入りに登録
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function onFavorite(Request $request)
    {
        try {
            $already = Favorite::where('user_id', $request['uid'])
                ->where('product_id', $request['productId'])
                ->first();
            if ($already) {
                $already->delete();
                $isFavorite = false;
            } else {
                $favorite = Favorite::create([
                    'user_id' => $request['uid'],
                    'product_id' => $request['productId']
                ]);
                if ($favorite) {
                    $isFavorite = true;
                }
            }
            return response()->json($isFavorite, 200);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * お気に入り済み商品の取得
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function favorite(Request $request)
    {
        try {
            $products = Product::open()->withRelations()->limited()->myFavorite($request['uid']);
            $max = $products->count();
            if ($request['more'] === 'true') {
                $products = $products->more($request['length'])->get();
            } else {
                $products = $products->index()->get();
            }
            return response()->json([
                'products' => $products,
                'max' => $max,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }
}
