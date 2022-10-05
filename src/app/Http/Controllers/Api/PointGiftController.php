<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PointGift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class PointGiftController extends Controller
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
            $point_gifts = collect([]);
            $available_point = 0;
            $max = 0;

            $request->merge(['uid' => 37]);

            // ユーザーがサインインしている場合
            if (!empty($request['uid'])) {
                // ユーザー
                $user = User::find($request['uid']);
                if ($user) {
                    $available_point = $user->available_point;
                    // ポイント景品履歴
                    $point_gifts = PointGift::open()
                        ->orderBy('id', 'desc');
                    $max = $point_gifts->count();
                    if ($request['more'] === 'true') {
                        $point_gifts = $point_gifts->more($request['length'])->get();
                    } else {
                        $point_gifts = $point_gifts->index()->get();
                    }
                }
            }

            $point_gifts = $point_gifts->map(function ($point_gift) use ($available_point) {
                    return [
                        'id' => $point_gift->id,
                        'name' => $point_gift->name,
                        'description' => $point_gift->description,
                        'point' => (Integer)$point_gift->point,
                        'available' => $point_gift->point <= $available_point ? 1 : 2,
                        'point_gift_pictures' => $point_gift->point_gift_pictures()->get()->map(function ($point_gift_picture) {
                            return [
                                'id' => $point_gift_picture->id,
                                'path' => $point_gift_picture->path,
                            ];
                        }),
                    ];
                })
                ->toArray();

            return response()->json([
                'point_gifts' => $point_gifts,
                'max' => $max,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }
}
