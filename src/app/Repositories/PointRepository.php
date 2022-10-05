<?php

namespace App\Repositories;

use App\Models\PointSearch;
use Carbon\Carbon;
use App\Models\Point;

class PointRepository implements PointRepositoryInterface
{
    public function search(PointSearch $search)
    {
        $query = $search->getQuery()
            ->select('points.*')
            ->leftJoin('users', 'points.user_id', '=', 'users.id')
            ->leftJoin('point_gifts', 'points.point_gift_id', '=', 'point_gifts.id')
            ->groupBy('points.id');
        // 区分
        if (!empty($search->type)) {
            $query->where('points.type', '=', $search['type']);
        }
        // キーワード検索
        if (!empty($search->keyword)) {
            $search_word = $search->keyword;
            $query->where(function ($q) use ($search_word) {
                $q->orWhere('users.nickname', 'LIKE', "%" . $search_word . "%")
                    ->orWhere('point_gifts.name', 'LIKE', "%" . $search_word . "%");
            });
        }

        return $query;
    }
}
