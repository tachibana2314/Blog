<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\Read;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    /**
     * ニュース一覧の取得
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $news = Information::published()
                ->WithRelations()
                ->latest('release_date')
                ->orderBy('id', 'desc');
            $max = $news->count();
            if ($request['more'] === 'true') {
                $news = $news->more($request['length'])->get();
            } else {
                $news = $news->index()->get();
            }
            return response()->json([
                'news' => $news,
                'max' => $max,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * ニュースの閲覧
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function onRead(Request $request)
    {
        try {
            $already = Read::where('user_id', $request['uid'])
                    ->where('information_id', $request['newsId'])
                    ->first();
            if (!$already) {
                Read::create([
                    'user_id' => $request['uid'],
                    'information_id' => $request['newsId']
                ]);
            }
            return response()->json(null, 200);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }


    /**
     * 全てのニュースを既読か判定
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ifAllRead(Request $request)
    {
        try {
            // 全てのニュースを既読かのフラグ
            $read = false;
            // ログインユーザーが未読のニュース
            $unreads = Information::published()->unread($request['uid'])->get();
            if ($unreads->isEmpty()) {
                $read = true;
            }
            return response()->json($read, 200);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }
}
