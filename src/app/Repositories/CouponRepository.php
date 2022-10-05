<?php

namespace App\Repositories;

use App\Models\CouponSearch;
use Goodby\CSV\Export\Standard\Exporter;
use Goodby\CSV\Export\Standard\ExporterConfig;
use Illuminate\Support\Facades\DB;

class CouponRepository implements CouponRepositoryInterface
{
    public function search(CouponSearch $search)
    {
        $query = $search->getQuery()
            ->select('coupons.*')
            ->groupBy('coupons.id');
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
        if (!empty($search->type)) {
            $query->where('type', '=', intval($search['type']));
        }
        return
            $query;
    }

    public function couponExport()
    {
        // ファイル名
        $file_name = 'クーポン取得履歴' . \Carbon\Carbon::now()->format('Y-m-d');
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
coupon_logs.id as "ID",
coupon_logs.created_at as "取得日",
coupon_logs.start_date as "開始日",
coupon_logs.end_date as "終了日",
CASE WHEN coupons.id IS NOT NULL THEN "通常" ELSE "スタンプカード" END as "区分",
CASE WHEN coupons.id IS NOT NULL THEN coupons.title ELSE stamp_coupons.title END as "クーポン",
users.nickname as "ニックネーム",
users.email as "メールアドレス",
users.gender as "性別（1:男性、2:女性）",
users.birthday as "誕生日"
from coupon_logs
left join users on users.id = coupon_logs.user_id
left join coupons on coupons.id = coupon_logs.coupon_id
left join stamp_coupons on stamp_coupons.id = coupon_logs.coupon_id
        ');

        foreach ($result as $key => $value) {
            if ($key == 0) :
                // 項目の取得
                $fields = ['ID', '取得日', '開始日', '終了日', '区分', 'クーポン', 'ニックネーム', 'メールアドレス', '性別（1:男性、2:女性）', '誕生日',];
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
