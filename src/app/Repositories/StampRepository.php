<?php

namespace App\Repositories;

use App\Models\StampCouponSearch;
use App\Models\StampCardSearch;
use Illuminate\Support\Facades\DB;
use Goodby\CSV\Export\Standard\Exporter;
use Goodby\CSV\Export\Standard\ExporterConfig;

class StampRepository implements StampRepositoryInterface
{
    public function searchCard(StampCardSearch $search_card)
    {
        
        $query = $search_card->getQuery()
            ->select('stamp_cards.*')
            ->groupBy('stamp_cards.id');
        // キーワード検索
        if (!empty($search_card->keyword_card)) {
            $search_word = $search_card->keyword_card;
            $query->where(function ($q) use ($search_word) {
                $q->where('title', 'LIKE', "%" . $search_word . "%");
            });
        }
        // 絞り込み
        if (!empty($search_card->card_status)) {
            $query->where('status', '=', intval($search_card['card_status']));
        }
        return
            $query;
    }

    public function search(StampCouponSearch $search_coupon)
    {
        $query = $search_coupon->getQuery()
            ->select('stamp_coupons.*')
            ->groupBy('stamp_coupons.id');
        // キーワード検索
        if (!empty($search_coupon->keyword)) {
            $search_word = $search_coupon->keyword;
            $query->where(function ($q) use ($search_word) {
                $q->where('title', 'LIKE', "%" . $search_word . "%");
            });
        }
        // 絞り込み
        if (!empty($search_coupon->status)) {
            $query->where('status', '=', intval($search_coupon['status']));
        }
        return
            $query;
    }

    public function stampExport()
    {
        // ファイル名
        $file_name = 'スタンプ履歴' . \Carbon\Carbon::now()->format('Y-m-d');
        // HTTPヘッダ定義
        date_default_timezone_set('Asia/Tokyo');
        header('Content-Disposition: attachment; filename*=UTF-8\'\''.rawurlencode($file_name).'.csv');
        header('Cache-Control: public');
        header('Pragma: public');
        header('Content-Type: application/octet-stream');

        // エクスポートデータの生成
        $data = [];
        $result = DB::select('
select
stamps.id as "ID",
stamps.created_at as "発生日時",
stamp_cards.title as "スタンプカード",
users.nickname as "ニックネーム",
users.email as "メールアドレス",
users.gender as "性別（1:男性、2:女性）",
users.birthday as "誕生日"
from stamps
left join stamp_cards on stamp_cards.id = stamps.stamp_card_id
left join users on users.id = stamps.user_id
        ');

        foreach ($result as $key => $value) {
            if ($key == 0) :
                // 項目の取得
                $fields = ['ID', '発生日時', 'スタンプカード', 'ニックネーム', 'メールアドレス', '性別（1:男性、2:女性）', '誕生日'];
                // 項目を追加
                $data[0] = $fields;
            endif;
            if ($fields) :
                foreach ($fields as $l => $w) :
                    $data[$key + 1][$l] = data_get($value, $w);
                endforeach;
            endif;
        }
        $config = new ExporterConfig();
        $config->setToCharset('SJIS-win')->setFromCharset('UTF-8');
        $exporter = new Exporter($config);
        $exporter->export('php://output', $data);
        exit;
    }
}
