<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Information;
use Carbon\Carbon;
use Google\Cloud\Firestore\FirestoreClient;

class InstantNewsNotification extends Command

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:instantNotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '管理画面のお知らせをユーザーに即時に通知する';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->firestore = new FirestoreClient([
            'projectId' => env('FIREBASE_PROJECT_ID'),
        ]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 実行テスト->成功すればログに出力
        logger()->info('This is Push Notification Command.');

        // お知らせ（公開かつ今日）情報取得
        $information = new Information;
        $information = $information
            ->where('push_flg', 1)
            ->orderBy('created_at', 'desc')
            ->first();

        // 許可している全ユーザーにプッシュ通知を送る
        $push_users = $this->firestore->collection('tokens')->documents();

        foreach ($push_users as $v) {
            $tokens[] = $v->data()['token'];
        }

        $payload = array(
            'to' => $tokens,
            'sound' => 'default',
            'title' => 'News',
            'body' => $information['title'],
            'data' => array(
                'screen' => 'News',
                'notification' => '新着お知らせ通知',
                'message' => '新しいお知らせを確認しますか？'
            )
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://exp.host/--/api/v2/push/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Accept-Encoding: gzip, deflate",
                "Content-Type: application/json",
                "cache-control: no-cache",
                "host: exp.host"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }

    }
}
