<?php

namespace App\Repositories;

use App\Models\ProductSearch;
use Goodby\CSV\Export\Standard\Exporter;
use Goodby\CSV\Export\Standard\ExporterConfig;
use Carbon\Carbon;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function search(ProductSearch $search)
    {
        $query = $search->getQuery()
            ->select('products.*')
            ->groupBy('products.id');
        // キーワード検索
        if (!empty($search->keyword)) {
            $search_word = $search->keyword;
            $query->where(function ($q) use ($search_word) {
                $q->where('name', 'LIKE', "%" . $search_word . "%");
            });
        }

        if (!empty($search->m_product_category_id)) {
            $query->where('products.m_product_category_id', '=', intval($search['m_product_category_id']));
        }
        // ステータス絞り込み
        if (!empty($search->status)) {
            $query->where('status', '=', intval($search['status']));
        }

        return
            $query;
    }

    public function productExport()
    {
        // この関数内のみメモリの上限値を以下の値に設定、処理が終了すると破棄する
        ini_set('memory_limit', '3000M');
        // 処理時間指定
        set_time_limit(300);
        // ファイル名
        $file_name = '商品一覧_' . \Carbon\Carbon::now()->format('Y-m-d');
        // HTTPヘッダ定義
        date_default_timezone_set('Asia/Tokyo');
        header('Content-Disposition: attachment; filename*=UTF-8\'\''.rawurlencode($file_name).'.csv');
        header('Cache-Control: public');
        header('Pragma: public');
        header('Content-Type: application/octet-stream');
        // エクスポートデータの生成
        $data = [];
        $fields = [];
        $product = new Product;
        $product = $product
            ->orderBy('id', 'asc')
            ->get();

        foreach ($product as $key => $value) {
            if ($key == 0) :
                // 項目を追加
                $data[0] = ['商品ID', '商品名', 'カテゴリー', '価格(＄)', 'ステータス', 'お気に入り登録数', '登録日'];
                // 項目の取得
                $fields = [
                    'id',
                    'name',
                    'm_product_category_id',
                    'price',
                    'status',
                    'favorite_count',
                    'created_at',
                ];
            endif;
            if ($fields) :
                foreach ($fields as $l => $w) :
                    // ドットでカラム名を分離
                    $k = explode('.', $w);
                    // ID
                    if ($w == 'id') :
                        $data[$key + 1][$l] = $value->id;
                    endif;
                    // 商品名
                    if ($w == 'name') :
                        $data[$key + 1][$l] = $value->name;
                    endif;
                    // カテゴリー
                    if ($w == 'm_product_category_id') :
                        $data[$key + 1][$l] = $value->category->name;
                    endif;
                    // 価格
                    if ($w == 'price') :
                        $data[$key + 1][$l] = $value->price;
                    endif;
                    // ステータス
                    if ($w == 'status') :
                        $data[$key + 1][$l] = $value->setStatusLabel();
                    endif;
                    // ステータス
                    if ($w == 'status') :
                        $data[$key + 1][$l] = $value->setStatusLabel();
                    endif;
                    // ステータス
                    if ($w == 'favorite_count') :
                        $data[$key + 1][$l] = $value->getfavoriteCountLabel();
                    endif;
                    // 登録日
                    if ($w == 'created_at') :
                        $data[$key + 1][$l] = $value['created_at']->format('Y.m.d');
                    endif;
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
