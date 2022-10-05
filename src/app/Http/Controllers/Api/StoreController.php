<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    /**
     * 店舗の取得
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $latitude = $request['latitude'];
        $longitude = $request['longitude'];

        try {
            // 店舗現在地からソート 6371(KM)、3959(MILE)
            $stores = Store::open()
                ->select('*', 
                DB::raw('6371 * ACOS(COS(RADIANS('.$latitude.')) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS('.$longitude.')) 
                    + SIN(RADIANS('.$latitude.')) * SIN(RADIANS(latitude))) as distance'))
                ->orderBy('distance');
            
            // キーワード
            if (!empty($request['keyword'])) {
                $stores = $stores->keyword($request['keyword']);
            }

            $max = $stores->count();
            if ($request['more'] === 'true') {
                $stores = $stores->more($request['length'])->get();
            } else {
                $stores = $stores->index()->get();
            }

            return response()->json([
                'stores' => $stores,
                'max' => $max,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'status' => 200,
            ]);
        } catch (\Exception $request) {
            return response()->json($request, 500);
        }
    }
}
