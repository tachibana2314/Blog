<?php

namespace App\Repositories;

use App\Models\PointGiftSearch;
use Carbon\Carbon;
use App\Models\PointGift;

class PointGiftRepository implements PointGiftRepositoryInterface
{
    public function search(PointGiftSearch $search)
    {
        $query = $search->getQuery()
            ->select('point_gifts.*')
            ->groupBy('point_gifts.id');
        // キーワード検索
        if (!empty($search->keyword)) {
            $search_word = $search->keyword;
            $query->where(function ($q) use ($search_word) {
                $q->where('name', 'LIKE', "%" . $search_word . "%");
            });
        }
        // ステータス絞り込み
        if (!empty($search->status)) {
            $query->where('status', intval($search['status']));
        }

        return $query;
    }
}
