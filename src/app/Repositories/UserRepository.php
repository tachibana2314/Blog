<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserSearch;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Goodby\CSV\Export\Standard\Exporter;
use Goodby\CSV\Export\Standard\ExporterConfig;

class UserRepository implements UserRepositoryInterface
{
    /**
     * 指定日のアクティブ会員数取得関数
     *
     * @param Int $month
     * @return Int
     */
    public function getUsersInADay(Int $last_day)
    {
        return User::withTrashed()
            ->where('created_at', '<=', Carbon::now()->subDay($last_day))
            ->where(function ($query) use ($last_day) {
                $query->orWhere('deleted_at', '>', Carbon::now()->subDay($last_day))
                    ->orWhereNull('deleted_at');
            })
            ->where(function ($query) use ($last_day) {
                $query->orWhere('left_at', '>', Carbon::now()->subDay($last_day))
                    ->orWhereNull('left_at');
            })
            ->count();
    }

    /**
     * 指定月のアクティブ会員数取得関数
     *
     * @param Int $month
     * @return Int
     */
    public function getUsersInAMonth(Int $last_month)
    {
        return User::withTrashed()
            ->where('created_at', '<=', Carbon::now()->subMonthsNoOverflow($last_month)->endOfMonth())
            ->where(function ($query) use ($last_month) {
                $query->orWhere('deleted_at', '>', Carbon::now()->subMonthsNoOverflow($last_month)->endOfMonth())
                    ->orWhereNull('deleted_at');
            })
            ->where(function ($query) use ($last_month) {
                $query->orWhere('left_at', '>', Carbon::now()->subMonthsNoOverflow($last_month)->endOfMonth())
                    ->orWhereNull('left_at');
            })
            ->count();
    }

    public function search(UserSearch $search)
    {
        $query = $search->getQuery()
            ->select('users.*')
            ->groupBy('users.id');
        // キーワード検索
        if (!empty($search->keyword)) {
            $search_word = $search->keyword;
            $query->where(function ($q) use ($search_word) {
                $q->where('nickname', 'LIKE', "%" . $search_word . "%");
            });
        }
        // 退会・登録絞り込み
        if (Arr::has($search, 'left_at')) {
            if ($search['left_at'] === '1') {
                $query->whereNull('left_at');
            } else {
                $query->whereNotNull('left_at');
            }
        }
        return $query;
    }

    public function userExport()
    {
        // ファイル名
        $file_name = '顧客一覧' . \Carbon\Carbon::now()->format('Y-m-d');
        // HTTPヘッダ定義
        date_default_timezone_set('Asia/Tokyo');
        header('Content-Disposition: attachment; filename*=UTF-8\'\''.rawurlencode($file_name).'.csv');
        header('Cache-Control: public');
        header('Pragma: public');
        header('Content-Type: application/octet-stream');

        // エクスポートデータの生成
        $data = [];
        $fields = [];
        $user = new User;
        $user = $user->orderBy('id', 'asc')->get();

        foreach ($user as $key => $value) {
            if ($key == 0) :
                // 項目を追加
                $data[0] = ['顧客ID', 'ニックネーム', '生年月日', 'メールアドレス', 'お気に入り登録数', 'クーポン使用数', '登録日'];
                // 項目の取得
                $fields = [
                    'id',
                    'nickname',
                    'birthday',
                    'email',
                    'favorite_count',
                    'coupon_histories_count',
                    'created_at',
                ];
            endif;
            if ($fields) :
                foreach ($fields as $l => $w) :
                    // ID
                    if ($w == 'id') :
                        $data[$key + 1][$l] = $value->id;
                    endif;
                    // ニックネーム
                    if ($w == 'nickname') :
                        $data[$key + 1][$l] = $value->nickname;
                    endif;
                    // // 性別
                    // if ($w == 'gender') :
                    //     $data[$key + 1][$l] = $value->getGenderLabelAttribute();
                    // endif;
                    // 誕生日
                    if ($w == 'birthday') :
                        $data[$key + 1][$l] = $value->birthday;
                    endif;
                    // メール
                    if ($w == 'email') :
                        $data[$key + 1][$l] = $value->email;
                    endif;
                    // お気に入り数
                    if ($w == 'favorite_count') :
                        $data[$key + 1][$l] = $value->getfavoriteCountLabel();
                    endif;
                    // クーポン履歴
                    if ($w == 'coupon_histories_count') :
                        $data[$key + 1][$l] = $value->getcouponCountLabel();
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
