<?php

namespace App\Repositories;

use App\Models\StoreSearch;

class StoreRepository implements StoreRepositoryInterface
{
    public function search(StoreSearch $search)
    {
        $query = $search->getQuery()
            ->select('stores.*')
            ->groupBy('stores.id');
        // キーワード検索
        if (!empty($search->keyword)) {
            $search_word = $search->keyword;
            $query->where(function ($q) use ($search_word) {
                $q->where('name', 'LIKE', "%" . $search_word . "%");
            });
        }
        // 絞り込み
        if (!empty($search->status)) {
            $query->where('status', '=', intval($search['status']));
        }
        if (!empty($search->cafe_flg == 1)) {
            $query->where('cafe_flg', 1);
        }
        if (!empty($search->wine_flg == 1)) {
            $query->where('wine_flg', 1);
        }
        if (!empty($search->oven_flg == 1)) {
            $query->where('oven_flg', 1);
        }
        if (!empty($search->cafe_flg == 2)) {
            $query->whereNull('cafe_flg');
        }
        if (!empty($search->wine_flg == 2)) {
            $query->whereNull('wine_flg');
        }
        if (!empty($search->oven_flg == 2)) {
            $query->whereNull('oven_flg');
        }
        return
            $query;
    }
}
