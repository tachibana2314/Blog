<?php

namespace App\Repositories;

use App\Models\AdminSearch;

class AdminRepository implements AdminRepositoryInterface
{
    public function search(AdminSearch $search)
    {
        $query = $search->getQuery()
            ->select('admins.*')
            ->groupBy('admins.id');

        // キーワード検索
        if (!empty($search->keyword)) {
            $search_word = $search->keyword;
            $query->where(function ($q) use ($search_word) {
                $q->where('first_name', 'LIKE', "%" . $search_word . "%")
                    ->orWhere('first_name', 'like', '%' . $search_word . '%')
                    ->orWhere('last_name', 'like', '%' . $search_word . '%')
                    ->orWhere('first_name_kana', 'like', '%' . $search_word . '%')
                    ->orWhere('last_name_kana', 'like', '%' . $search_word . '%')
                    ->orWhere('position', 'like', '%' . $search_word . '%')
                    ->orWhere('department', 'like', '%' . $search_word . '%');
            });
        }
        return $query;
    }
}
