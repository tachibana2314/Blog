<?php

namespace App\Repositories;

use App\Models\InformationSearch;
use App\Console\Commands\NewsNotification;
use Carbon\Carbon;
use App\Models\Information;
use Google\Cloud\Firestore\FirestoreClient;

class InformationRepository implements InformationRepositoryInterface
{
    public function __construct()
    {
        $this->firestore = new FirestoreClient([
            'projectId' => env('FIREBASE_PROJECT_ID'),
        ]);
    }

    public function search(InformationSearch $search)
    {
        $query = $search->getQuery()
            ->select('informations.*')
            ->groupBy('informations.id');
        // キーワード検索
        if (!empty($search->keyword)) {
            $search_word = $search->keyword;
            $query->where(function ($q) use ($search_word) {
                $q->where('title', 'LIKE', "%" . $search_word . "%");
            });
        }
        // 絞り込み
        if (!empty($search->status)) {
            $query->where('status', '=', intval($search['status']));
        }
        return
            $query;
    }
}
